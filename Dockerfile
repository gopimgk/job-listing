# ---------- Stage 1: Vite asset builder ----------
FROM node:18 AS vite-builder

WORKDIR /app

# Copy only what's needed for Vite build
COPY package*.json vite.config.js ./
COPY resources/ resources/
COPY public/ public/

RUN npm install && npm run build

# ---------- Stage 2: Laravel + PHP ----------
FROM php:8.2

# Install PHP extensions
RUN apt-get update && apt-get install -y \
    git curl unzip zip libpng-dev libonig-dev libxml2-dev \
    libpq-dev nodejs npm \
    && docker-php-ext-install pdo pdo_pgsql

# Install Composer
COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

# Copy entire Laravel app
COPY . .

# ✅ Copy built Vite assets from builder
COPY --from=vite-builder /app/public/build ./public/build

# Install PHP dependencies
RUN composer install --optimize-autoloader --no-dev

# Set permissions
RUN chown -R www-data:www-data storage bootstrap/cache public/build

EXPOSE 80

# Start Laravel
CMD ["sh", "-c", "php artisan config:cache && php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=80"]
