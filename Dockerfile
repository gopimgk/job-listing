FROM php:8.2

RUN apt-get update && apt-get install -y \
    git curl unzip zip libpng-dev libonig-dev libxml2-dev \
    nodejs npm

COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

COPY . .

RUN composer install --optimize-autoloader --no-dev

RUN npm install && npm run build

RUN chown -R www-data:www-data storage bootstrap/cache public/build

EXPOSE 80

# ❌ No key:generate
# ✅ Migrate + serve
CMD ["sh", "-c", "php artisan config:cache && php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=80"]
