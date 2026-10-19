FROM dunglas/frankenphp:1-php8.4-bookworm

# Dependencias del sistema y compilación de extensiones PHP
RUN apt-get update \
    && apt-get install -y --no-install-recommends \
        $PHPIZE_DEPS \
        libpq-dev \
        libicu-dev \
        libzip-dev \
        git \
        unzip \
    && docker-php-ext-install -j"$(nproc)" \
        pdo_pgsql \
        pdo_mysql \
        intl \
        zip \
        bcmath \
        opcache \
        pcntl \
    && apt-get purge -y --auto-remove $PHPIZE_DEPS \
    && rm -rf /var/lib/apt/lists/*

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app

# Dependencias del proyecto
COPY composer.json composer.lock ./

RUN composer install \
    --no-interaction \
    --prefer-dist \
    --no-scripts \
    --no-progress

# Código Laravel
COPY . .

# Directorios necesarios para Laravel
RUN mkdir -p \
    storage/framework/cache \
    storage/framework/sessions \
    storage/framework/views \
    storage/logs \
    bootstrap/cache \
    && chown -R www-data:www-data storage bootstrap/cache

# Configuración FrankenPHP
COPY Docker/php/Caddyfile /etc/frankenphp/Caddyfile

EXPOSE 80
