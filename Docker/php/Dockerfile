
# ==========================================
# Etapa 1: compilar Vite
# ==========================================
FROM node:22-bookworm-slim AS frontend

WORKDIR /app

COPY package.json ./
RUN npm install

COPY . .
RUN npm run build


# ==========================================
# Etapa 2: Laravel + FrankenPHP
# ==========================================
FROM dunglas/frankenphp:1.13.2-php8-alpine

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
    --no-progress \
    --no-dev \
    --optimize-autoloader

COPY . .

# Copiar los assets compilados
COPY --from=frontend /app/public/build ./public/build

RUN mkdir -p \
    storage/framework/cache \
    storage/framework/sessions \
    storage/framework/views \
    storage/logs \
    bootstrap/cache \
    && chown -R www-data:www-data storage bootstrap/cache

COPY Docker/php/Caddyfile /etc/frankenphp/Caddyfile

EXPOSE 80
