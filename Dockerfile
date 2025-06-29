FROM php:8.2

# System dependencies
RUN apt-get update && apt-get install -y \
    git curl zip unzip libpng-dev libonig-dev libxml2-dev \
    nodejs npm

# Install Composer
COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer

# Set working dir
WORKDIR /var/www

# Copy code
COPY . .

# PHP deps
RUN composer install --optimize-autoloader --no-dev

# Node deps & build
RUN npm install && npm run build

# Permissions
RUN chown -R www-data:www-data storage bootstrap/cache public/build

# EXPOSE HTTP port
EXPOSE 80

# Start Laravel built-in server
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=80"]
