# --- Stage 1: Node for Vite asset build ---
FROM node:18 AS vite-builder

WORKDIR /app

# Copy required files first to leverage Docker caching
COPY package*.json vite.config.js ./

# Optional: copy config files if using Tailwind/PostCSS
COPY tailwind.config.js postcss.config.js ./

# Install deps first (faster rebuilds)
RUN npm install

# Copy app resources
COPY resources/ resources/
COPY public/ public/

# Build Vite assets
RUN npm run build

# --- Stage 2: PHP + Laravel ---
FROM php:8.2

# Install PHP extensions & system dependencies
RUN apt-get update && apt-get install -y \
    git curl unzip zip libpng-dev libonig-dev libxml2-dev \
    libpq-dev nodejs npm \
    && docker-php-ext-install pdo pdo_pgsql

# Add Composer
COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

# Copy Laravel source code
COPY . .

# ✅ Copy compiled Vite build from Node stage
COPY --from=vite-builder /app/public/build public/build

# ✅ Install PHP dependencies
RUN composer install --optimize-autoloader --no-dev

# ✅ Set correct permissions
RUN chown -R www-data:www-data storage bootstrap/cache public/build

# ✅ Expose port
EXPOSE 80

# ✅ Start Laravel with HTTPS handling
CMD ["sh", "-c", "php artisan config:cache && php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=80"]
