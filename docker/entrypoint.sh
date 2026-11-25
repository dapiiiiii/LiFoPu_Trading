#!/bin/sh
# Container start-up: wait for the database, migrate, cache the config, then run Apache.
set -e
cd /var/www/html

# On Render the public address is known only at run time.
if [ -z "$APP_URL" ] && [ -n "$RENDER_EXTERNAL_URL" ]; then
    export APP_URL="$RENDER_EXTERNAL_URL"
fi

if [ -z "$APP_KEY" ]; then
    echo "APP_KEY is not set. Put it in .env (php artisan key:generate --show) or pass it to the container." >&2
    exit 1
fi

# Sessions and cache live in the database, so nothing works until it answers.
case "${DB_CONNECTION:-mysql}" in mysql|mariadb|pgsql)
    echo "Waiting for the ${DB_CONNECTION:-mysql} database: host=${DB_HOST:-127.0.0.1} port=${DB_PORT:-default} database=${DB_DATABASE} user=${DB_USERNAME}"
    tries=0
    until err=$(php -r '
        $pg = getenv("DB_CONNECTION") === "pgsql";
        $dsn = ($pg ? "pgsql" : "mysql").":host=".getenv("DB_HOST").";port=".(getenv("DB_PORT") ?: ($pg ? 5432 : 3306)).";dbname=".getenv("DB_DATABASE");
        try { new PDO($dsn, getenv("DB_USERNAME"), getenv("DB_PASSWORD")); } catch (Throwable $e) { echo $e->getMessage(); exit(1); }' 2>&1); do
        tries=$((tries + 1))
        # Every 5th attempt, and the last one, show why it fails (wrong host, password, database name...).
        if [ $((tries % 5)) -eq 1 ] || [ "$tries" -ge 30 ]; then
            echo "  not yet: $err" >&2
        fi
        if [ "$tries" -ge 30 ]; then
            echo "The database did not answer after 60 seconds. Check DB_HOST, DB_DATABASE, DB_USERNAME and DB_PASSWORD against the database's Connections page on Render." >&2
            exit 1
        fi
        sleep 2
    done
esac

if [ "${RUN_MIGRATIONS:-true}" = "true" ]; then
    php artisan migrate --force
fi

# Cache config, routes, views and events for speed.
php artisan optimize

# Anything the commands above wrote must stay writable for Apache.
chown -R www-data:www-data storage bootstrap/cache

exec "$@"
