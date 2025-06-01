#!/bin/bash

# Jalankan PHP-FPM di background
php-fpm &

# Tunggu beberapa detik agar PHP-FPM benar-benar siap
sleep 3

# Jalankan Nginx di foreground
nginx -g "daemon off;"
