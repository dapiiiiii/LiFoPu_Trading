#!/bin/sh
# Container start-up: wait for the database, migrate, cache the config, then run Apache.
set -e
cd /var/www/html

if [ -z "$APP_KEY" ]; then
    echo "APP_KEY is not set. Put it in .env (php artisan key:generate --show) or pass it to the container." >&2
    exit 1
fi

# Sessions and cache live in the database, so nothing works until it answers.
if [ "${DB_CONNECTION:-mysql}" = "mysql" ] || [ "${DB_CONNECTION}" = "mariadb" ]; then
    echo "Waiting for the database at ${DB_HOST:-127.0.0.1}:${DB_PORT:-3306}..."
    tries=0
    until php -r 'try { new PDO("mysql:host=".getenv("DB_HOST").";port=".(getenv("DB_PORT") ?: 3306).";dbname=".getenv("DB_DATABASE"), getenv("DB_USERNAME"), getenv("DB_PASSWORD")); } catch (Throwable $e) { exit(1); }' 2>/dev/null; do
        tries=$((tries + 1))
        if [ "$tries" -ge 30 ]; then
            echo "The database did not answer after 60 seconds." >&2
            exit 1
        fi
        sleep 2
    done
fi

if [ "${RUN_MIGRATIONS:-true}" = "true" ]; then
    php artisan migrate --force
fi

# Cache config, routes, views and events for speed.
php artisan optimize

# Anything the commands above wrote must stay writable for Apache.
chown -R www-data:www-data storage bootstrap/cache

exec "$@"
