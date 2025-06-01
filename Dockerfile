FROM richarvey/nginx-php-fpm:latest

# Set working directory to match expected webroot
WORKDIR /var/www/html

# Create socket directory and set permissions
RUN mkdir -p /var/run/php && \
    chown -R www-data:www-data /var/run/php

COPY . .

# Image config
ENV SKIP_COMPOSER 1
ENV WEBROOT /var/www/html/public
ENV PHP_ERRORS_STDERR 1
ENV RUN_SCRIPTS 1
ENV REAL_IP_HEADER 1

# Laravel config
ENV APP_ENV production
ENV APP_DEBUG true
ENV LOG_CHANNEL stderr

# Allow composer to run as root
ENV COMPOSER_ALLOW_SUPERUSER 1

CMD ["/start.sh"]
