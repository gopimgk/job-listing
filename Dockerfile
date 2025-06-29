# -------- Stage 1: Node + Vite build --------
FROM node:18 AS node-builder

WORKDIR /app

COPY package*.json vite.config.js ./
COPY resources/ resources/
COPY public/ public/

RUN npm install && npm run build

# -------- Stage 2: PHP + Laravel --------
FROM php:8.2

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git curl unzip zip libpng-dev libonig-dev libxml2-dev \
    libpq-dev nodejs npm \
    && docker-php-ext-install pdo pdo_pgsql

# Install Composer
COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Copy project files
COPY . .

# Copy compiled assets from node-builder
COPY --from=node-builder /app/public/build public/build

# Install PHP dependencies
RUN composer install --optimize-autoloader --no-dev

# Set correct permissions
RUN chown -R www-data:www-data storage bootstrap/cache public/build

# Expose HTTP port
EXPOSE 80

# Start Laravel
CMD ["sh", "-c", "php artisan config:cache && php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=80"]
