FROM php:8.2

# Install system packages
RUN apt-get update && apt-get install -y \
    git curl unzip zip libpng-dev libonig-dev libxml2-dev \
    nodejs npm

# Install Composer
COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Copy project files
COPY . .

# Install PHP dependencies
RUN composer install --optimize-autoloader --no-dev

# Build Vite assets
RUN npm install && npm run build

# Set proper permissions
RUN chown -R www-data:www-data storage bootstrap/cache public/build

# Expose port 80
EXPOSE 80

# ❌ DO NOT run php artisan in build steps
# ✅ Run artisan commands after container starts
CMD ["/bin/sh", "-c", "php artisan config:cache && php artisan key:generate && php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=80"]
