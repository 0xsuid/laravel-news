FROM php:7.4-fpm-alpine

RUN docker-php-ext-install pdo pdo_mysql

# COPY src/ /var/www/html/
# RUN chown -R $USER:www-data ./storage ./bootstrap/cache
