FROM php:8.2-apache

RUN apt-get update && apt-get install -y libpq-dev libzip-dev unzip git \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pdo pdo_pgsql pgsql pdo_mysql zip

RUN pecl install redis && docker-php-ext-enable redis

RUN a2enmod rewrite

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /app

COPY . .

RUN composer install --ignore-platform-req=ext-http

CMD php artisan serve --host=0.0.0.0 --port=8080
