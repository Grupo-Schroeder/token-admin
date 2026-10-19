
# ==========================================
# Etapa 1: compilar frontend con Vite
# ==========================================
FROM node:22-bookworm-slim AS frontend

WORKDIR /app

RUN node --version && npm --version

COPY package.json ./
RUN npm install

COPY . .
RUN npm run build


# ==========================================
# Etapa 2: aplicación Laravel + FrankenPHP
# ==========================================
FROM dunglas/frankenphp:1-php8.4-bookworm AS production

# Dependencias del sistema y extensiones PHP
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

# Dependencias PHP
COPY package.json ./
RUN npm install

RUN composer install \
    --no-dev \
    --no-interaction \
    --prefer-dist \
    --no-scripts \
    --no-progress \
    --optimize-autoloader

# Código de Laravel
COPY . .

# Assets compilados de Vite
COPY --from=frontend /app/public/build ./public/build

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
