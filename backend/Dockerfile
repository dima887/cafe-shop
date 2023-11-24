FROM php:8.2-apache

RUN apt-get update && apt-get install -y libpq-dev libzip-dev unzip git \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pdo pdo_pgsql pgsql pdo_mysql zip

RUN pecl install redis && docker-php-ext-enable redis

#RUN pecl install pecl_http
#RUN echo "extension=http.so" >> /usr/local/etc/php/php.ini

RUN a2enmod rewrite

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www/html

COPY . .

RUN composer install --ignore-platform-req=ext-http

RUN php artisan key:generate

CMD php artisan serve --host=0.0.0.0 --port=8080
