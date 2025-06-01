FROM richarvey/nginx-php-fpm:latest

# Copy configuration files first
COPY conf/nginx/nginx-site.conf /etc/nginx/sites-available/default.conf
COPY conf/php/php-fpm.conf /usr/local/etc/php-fpm.d/www.conf

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

COPY start.sh /start.sh
RUN chmod +x /start.sh

ENV SKIP_COMPOSER 0
ENV WEBROOT /var/www/html/public
ENV PHP_ERRORS_STDERR 1
ENV RUN_SCRIPTS 1
ENV REAL_IP_HEADER 1

ENV APP_ENV production
ENV APP_DEBUG false
ENV LOG_CHANNEL stderr

ENV COMPOSER_ALLOW_SUPERUSER 1

# Create necessary directories and set permissions
RUN mkdir -p /var/run/php && \
    chown -R www-data:www-data /var/run/php && \
    chown -R www-data:www-data /var/www/html && \
    chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

CMD ["/start.sh"]
