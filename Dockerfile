# Use official PHP image with Composer pre-installed
FROM php:8.2-cli

# Set working directory
WORKDIR /var/www

# Install system dependencies
RUN apt-get update && apt-get install -y \
    libpq-dev \
    unzip \
    zip \
    git \
    curl

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_pgsql

# Install Composer from official composer image
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy Laravel app source code
COPY . .

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Ensure start script is copied and executable
COPY start.sh /var/www/start.sh
RUN chmod +x /var/www/start.sh

# Set the start command
CMD ["/var/www/start.sh"]
