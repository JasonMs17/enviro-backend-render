#!/bin/bash

# Create socket directory and set permissions
mkdir -p /var/run/php
chown -R www-data:www-data /var/run/php
chmod 755 /var/run/php

# Start PHP-FPM
php-fpm -F &

# Wait for PHP-FPM to be ready
sleep 2

# Start Nginx
nginx -g 'daemon off;'
