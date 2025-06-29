#!/bin/sh

# Run Laravel migrations on Render
php artisan migrate --force

# Optional: cache config to boost performance
php artisan config:cache

# Start Laravel app (required for Docker on Render)
php artisan serve --host=0.0.0.0 --port=8080
