FROM php:7.3-fpm

RUN apt-get update && apt-get install -y \
    curl \
    wget \
    libicu-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libmcrypt-dev \
    libpng-dev \
    libpq-dev \
    libxml2-dev \
    git \
    unzip \
    zlibc \
    libzip-dev

RUN pecl install xdebug-2.7.0beta1 && \
    docker-php-ext-enable xdebug \
    && docker-php-ext-configure gd \
        --enable-gd-native-ttf \
        --with-jpeg-dir=/usr/lib \
    && docker-php-ext-install gd \
    && docker-php-ext-install opcache \
    && docker-php-ext-enable opcache \
    && echo xdebug.remote_enable=1 >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo xdebug.remote_port=9001 >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo xdebug.remote_host=host.docker.internal >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

RUN docker-php-ext-install \
    zip \
    iconv \
    soap \
    sockets \
    intl \
    pdo_mysql \
    exif \
    pcntl

# Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www/app
