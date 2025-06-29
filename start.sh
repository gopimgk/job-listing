#!/bin/bash
set -e

echo "🚀 Caching config..."
php artisan config:cache

echo "📦 Running migrations..."
php artisan migrate --force

echo "🟢 Starting Laravel server..."
php artisan serve --host=0.0.0.0 --port=8080
