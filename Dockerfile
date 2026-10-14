FROM php:8.3-cli

RUN apt-get update \
    && apt-get install -y --no-install-recommends git unzip libzip-dev libsqlite3-dev libonig-dev \
    && docker-php-ext-install pdo pdo_sqlite mbstring zip \
    && rm -rf /var/lib/apt/lists/*

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

# This repository contains the Coursio app files, not a complete Laravel skeleton.
# Generate the Laravel 12 framework during the image build, then overlay Coursio's routes/controller/view.
RUN composer create-project laravel/laravel . "^12.0" --no-interaction --prefer-dist --no-dev

COPY routes/web.php /var/www/routes/web.php
COPY app/Http/Controllers/LibraryController.php /var/www/app/Http/Controllers/LibraryController.php
COPY resources/views/library.blade.php /var/www/resources/views/library.blade.php
COPY docker-entrypoint.sh /usr/local/bin/docker-entrypoint

ENV APP_ENV=production \
    APP_DEBUG=false \
    LOG_CHANNEL=stderr \
    SESSION_DRIVER=file \
    CACHE_STORE=file \
    QUEUE_CONNECTION=sync \
    DB_CONNECTION=sqlite

RUN chmod +x /usr/local/bin/docker-entrypoint \
    && mkdir -p storage/framework/cache/data storage/framework/sessions storage/framework/views storage/logs bootstrap/cache database \
    && chown -R www-data:www-data storage bootstrap/cache database

EXPOSE 8080
CMD ["docker-entrypoint"]
