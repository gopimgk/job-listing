FROM php:8.2

# Install system dependencies + PostgreSQL driver
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

# Install PHP dependencies
RUN composer install --optimize-autoloader --no-dev

# Build frontend assets
RUN npm install && npm run build

# Set correct permissions
RUN chown -R www-data:www-data storage bootstrap/cache public/build

# Expose port 80
EXPOSE 80

# Start Laravel and run DB migration
CMD ["sh", "-c", "php artisan config:cache && php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=80"]
