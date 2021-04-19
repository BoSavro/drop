FROM php:8-fpm-alpine

RUN set -xe && apk update && apk add --no-cache \
    libzip \
    bash \
    curl \
    libmcrypt \
    libmcrypt-dev \
    libxml2-dev \
    pcre-dev \
    git \
    autoconf \
    g++ \
    make \
    icu-dev \
    composer $PHPIZE_DEPS icu-dev icu-libs git \
    libzip-dev libmcrypt-dev libsodium libsodium-dev oniguruma oniguruma-dev \
    && pecl install xdebug-3.0.1 \
    && docker-php-ext-enable xdebug \
    && docker-php-source delete


COPY php.ini /usr/local/etc/php/conf.d/symfony.ini

WORKDIR /var/www
