FROM php:8.2-apache

USER root

WORKDIR /var/www/html

RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    zlib1g-dev \
    libxml2-dev \
    libzip-dev \
    libonig-dev \
    libssl-dev \
    libcurl4-openssl-dev \
    zip \
    curl \
    unzip \
    nano \ 
    openssl

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN docker-php-ext-install bcmath
RUN docker-php-ext-install ctype
RUN docker-php-ext-install fileinfo
RUN docker-php-ext-install mbstring
RUN docker-php-ext-install pdo
RUN docker-php-ext-install pdo_mysql
RUN docker-php-ext-install xml
RUN docker-php-ext-install zip
RUN docker-php-ext-install opcache
RUN docker-php-ext-configure gd
RUN docker-php-ext-install -j$(nproc) gd

# Configure Apache
COPY .docker/vhost.conf /etc/apache2/sites-available/000-default.conf
RUN a2enmod rewrite

# Set proper permissions for the Laravel app
RUN chown -R www-data:www-data /var/www/html
