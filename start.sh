#!/bin/bash

# Create necessary directories
mkdir -p /var/run/php
chown -R www-data:www-data /var/run/php

# Set proper permissions
chown -R www-data:www-data /var/www/html
chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache
chmod -R 775 /var/www/html/public
chmod -R 775 /var/www/html/config
chmod -R 775 /var/www/html/database

# Clear Laravel caches
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear

# Regenerate Laravel caches
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Start PHP-FPM
php-fpm -F &

# Wait for PHP-FPM to be ready
sleep 3

# Start Nginx
nginx -g "daemon off;"
