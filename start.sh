#!/bin/bash

# Jalankan PHP-FPM di background dengan konfigurasi TCP
php-fpm -F &

# Tunggu beberapa detik agar PHP-FPM benar-benar siap
sleep 3

# Jalankan Nginx di foreground
nginx -g "daemon off;"
