FROM php:7.4-fpm-alpine

RUN apk update && apk add --no-cache \
    libzip-dev \
    libpng-dev \
    libxml2-dev \
    # install required php extensions
    && docker-php-ext-install \
    pdo \
    pdo_mysql \
    zip \
    gd \
    simplexml

# install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin/ --filename=composer
