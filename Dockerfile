# syntax=docker/dockerfile:1
# LiFoPu Trading: Laravel 12 on PHP 8.2 + Apache, with the Vite assets built inside the image.
#   docker compose up -d --build      (site on http://localhost:8080, see docker-compose.yml)

# ---------------------------------------------------------------------------
# 1. Front-end assets (Vite + Tailwind) -> public/build
# ---------------------------------------------------------------------------
FROM node:22-alpine AS assets
WORKDIR /app
ENV PLAYWRIGHT_SKIP_BROWSER_DOWNLOAD=1
# Optional extra CA certificates (docker/certs/*.crt), e.g. for antivirus HTTPS scanning.
COPY docker/certs/ /tmp/certs/
RUN cat /tmp/certs/*.crt > /tmp/extra-ca.crt 2>/dev/null || true
ENV NODE_EXTRA_CA_CERTS=/tmp/extra-ca.crt
COPY package.json package-lock.json ./
RUN npm ci --no-audit --no-fund
COPY vite.config.js ./
COPY resources ./resources
RUN npm run build

# ---------------------------------------------------------------------------
# 2. PHP dependencies (production only)
# ---------------------------------------------------------------------------
FROM composer:2 AS vendor
WORKDIR /app
COPY docker/certs/ /tmp/certs/
RUN cat /etc/ssl/certs/ca-certificates.crt /tmp/certs/*.crt > /tmp/ca-bundle.crt 2>/dev/null \
    || cp /etc/ssl/certs/ca-certificates.crt /tmp/ca-bundle.crt
ENV COMPOSER_CAFILE=/tmp/ca-bundle.crt
COPY composer.json composer.lock ./
RUN composer install --no-dev --no-interaction --no-progress --prefer-dist \
    --no-scripts --no-autoloader --ignore-platform-reqs

# ---------------------------------------------------------------------------
# 3. Runtime: PHP 8.2 + Apache
# ---------------------------------------------------------------------------
FROM php:8.2-apache AS app

RUN apt-get update \
    && apt-get install -y --no-install-recommends libicu-dev libzip-dev libpq-dev unzip \
    && docker-php-ext-install -j"$(nproc)" pdo_mysql pdo_pgsql intl zip bcmath opcache \
    && rm -rf /var/lib/apt/lists/*

# Serve from public/ and let Laravel's .htaccess handle the routes.
# Apache listens on $PORT: 80 by default, Render and similar hosts set their own.
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
ENV PORT=80
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf \
    && sed -ri -e 's/^Listen 80$/Listen ${PORT}/' /etc/apache2/ports.conf \
    && sed -ri -e 's/<VirtualHost \*:80>/<VirtualHost *:${PORT}>/' /etc/apache2/sites-available/000-default.conf \
    && a2enmod rewrite headers \
    && printf '<Directory ${APACHE_DOCUMENT_ROOT}>\n    AllowOverride All\n    Require all granted\n</Directory>\nServerName localhost\nServerTokens Prod\nServerSignature Off\n' \
       > /etc/apache2/conf-available/laravel.conf \
    && a2enconf laravel

RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"
COPY docker/php.ini "$PHP_INI_DIR/conf.d/zz-lifopu.ini"

WORKDIR /var/www/html
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
COPY --from=vendor /app/vendor ./vendor
COPY . .
COPY --from=assets /app/public/build ./public/build

# Autoloader + package discovery for the production packages, then hand storage to Apache.
RUN rm -rf docker/certs \
    && composer dump-autoload --optimize --no-dev --no-interaction \
    && mkdir -p storage/framework/cache/data storage/framework/sessions storage/framework/views storage/logs \
    && chown -R www-data:www-data storage bootstrap/cache

COPY docker/entrypoint.sh /usr/local/bin/lifopu-entrypoint
RUN sed -i 's/\r$//' /usr/local/bin/lifopu-entrypoint && chmod +x /usr/local/bin/lifopu-entrypoint

EXPOSE 80
ENTRYPOINT ["lifopu-entrypoint"]
CMD ["apache2-foreground"]
