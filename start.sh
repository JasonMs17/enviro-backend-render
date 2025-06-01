#!/bin/bash

# Start PHP-FPM
php-fpm -F &

# Wait for PHP-FPM to be ready
sleep 3

# Start Nginx
nginx -g "daemon off;"
