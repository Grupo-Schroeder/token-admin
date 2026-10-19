FROM dunglas/frankenphp:1-php8.4-bookworm

RUN install-php-extensions \
    pdo_pgsql \
    pdo_mysql \
    intl \
    zip \
    opcache \
    pcntl \
    bcmath

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app

COPY composer.json composer.lock ./

RUN composer install \
    --no-interaction \
    --prefer-dist \
    --no-scripts \
    --no-progress

COPY . .

RUN mkdir -p \
    storage/framework/cache \
    storage/framework/sessions \
    storage/framework/views \
    storage/logs \
    bootstrap/cache \
    && chown -R www-data:www-data storage bootstrap/cache

COPY Docker/php/Caddyfile /etc/frankenphp/Caddyfile

EXPOSE 80

