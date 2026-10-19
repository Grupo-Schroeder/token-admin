# Etapa 1: compilar los assets de Vite
FROM node:22-bookworm-slim AS frontend

WORKDIR /app

COPY package.json package-lock.json ./
RUN npm ci

COPY . .
RUN npm run build


# Etapa 2: preparar PHP y Laravel
FROM php:8.5-cli-bookworm AS production

RUN apt-get update && apt-get install -y --no-install-recommends \
    git unzip libpq-dev libzip-dev libicu-dev libonig-dev \
    && docker-php-ext-install -j"$(nproc)" \
       pdo_pgsql mbstring bcmath intl zip pcntl \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app

# Copiar la aplicación
COPY . .

# Instalar dependencias PHP de producción
RUN composer install \
    --no-dev \
    --prefer-dist \
    --no-interaction \
    --optimize-autoloader

# Copiar los archivos compilados por Vite
COPY --from=frontend /app/public/build ./public/build

EXPOSE 8000


