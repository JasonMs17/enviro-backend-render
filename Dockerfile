FROM richarvey/nginx-php-fpm:latest

# Copy composer files first
COPY composer.json composer.lock ./

# Install composer dependencies
RUN composer install --no-scripts --no-autoloader

# Copy application files
COPY . .

# Generate autoload files
RUN composer dump-autoload --optimize

# Set up Laravel
RUN php artisan config:cache && \
    php artisan route:cache && \
    php artisan view:cache

# Image config
ENV SKIP_COMPOSER 1
ENV WEBROOT /var/www/html/public
ENV PHP_ERRORS_STDERR 1
ENV RUN_SCRIPTS 1
ENV REAL_IP_HEADER 1

# Laravel config
ENV APP_ENV production
ENV APP_DEBUG false
ENV LOG_CHANNEL stderr

# Allow composer to run as root
ENV COMPOSER_ALLOW_SUPERUSER 1

# Ensure PHP-FPM listens on TCP
RUN echo "listen = 127.0.0.1:9000" >> /usr/local/etc/php-fpm.d/www.conf

CMD ["/start.sh"]
