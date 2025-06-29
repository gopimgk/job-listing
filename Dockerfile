# Base image with PHP and system deps
FROM php:8.2-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git curl unzip zip libpng-dev libonig-dev libxml2-dev \
    npm nodejs

# Install Composer
COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Copy everything into container
COPY . .

# Install PHP deps
RUN composer install --optimize-autoloader --no-dev

# Install Node dependencies and build Vite assets
RUN npm install && npm run build

# Set correct permissions for Laravel
RUN chown -R www-data:www-data storage bootstrap/cache public/build

# Expose port and start php-fpm
EXPOSE 9000
CMD ["php-fpm"]
