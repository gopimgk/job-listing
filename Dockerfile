# Use official PHP image with Composer pre-installed
FROM php:8.2-cli

# Set working directory
WORKDIR /var/www

# Install dependencies
RUN apt-get update && apt-get install -y \
    libpq-dev \
    unzip \
    zip \
    git \
    curl

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_pgsql

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy project files
COPY . .

# Install dependencies
RUN composer install --no-dev --optimize-autoloader

# Laravel config
RUN php artisan config:cache

# Run Laravel
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8080"]
