# Use official PHP base image with necessary extensions
FROM php:8.2

# Install required system packages and Node.js
RUN apt-get update && apt-get install -y \
    git curl unzip zip libpng-dev libonig-dev libxml2-dev \
    npm nodejs

# Install Composer
COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer

# Set the working directory
WORKDIR /var/www

# Copy the Laravel project files to the container
COPY . .

# Install PHP dependencies
RUN composer install --optimize-autoloader --no-dev

# Generate application key
RUN php artisan key:generate

# Run database migrations (optional, comment if using post-deploy script)
RUN php artisan migrate --force

# Build Vite assets
RUN npm install && npm run build

# Set correct permissions for storage and cache
RUN chown -R www-data:www-data storage bootstrap/cache public/build

# Cache Laravel configuration
RUN php artisan config:cache \
    && php artisan route:cache \
    && php artisan view:cache

# Expose port 80 for HTTP traffic
EXPOSE 80

# Start Laravel using its built-in development server
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=80"]
