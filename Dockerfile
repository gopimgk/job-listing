# --- Stage 1: Node for Vite asset build ---
FROM node:18 AS vite-builder

WORKDIR /app

COPY package*.json vite.config.js ./
COPY resources/ resources/
COPY public/ public/

RUN npm install && npm run build

# --- Stage 2: PHP + Laravel ---
FROM php:8.2

RUN apt-get update && apt-get install -y \
    git curl unzip zip libpng-dev libonig-dev libxml2-dev \
    libpq-dev nodejs npm \
    && docker-php-ext-install pdo pdo_pgsql

COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

COPY . .

# ✅ Copy built Vite assets
COPY --from=vite-builder /app/public/build public/build

# ✅ Composer install (Laravel)
RUN composer install --optimize-autoloader --no-dev

# ✅ Permissions
RUN chown -R www-data:www-data storage bootstrap/cache public/build

EXPOSE 80

CMD ["sh", "-c", "php artisan config:cache && php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=80"]
