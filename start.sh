#!/bin/bash

# Create necessary directories
mkdir -p /var/run/php
chown -R www-data:www-data /var/run/php

# Start PHP-FPM
php-fpm -F &

# Wait for PHP-FPM to be ready
sleep 3

# Start Nginx
nginx -g "daemon off;"
