FROM php:8.1.5-fpm

RUN apt-get update
RUN apt-get upgrade -y

RUN docker-php-ext-install pdo_mysql
RUN docker-php-ext-install mysqli

RUN apt-get install -y git curl zip unzip nodejs npm
RUN apt-get clean

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer

WORKDIR /var/www/html/

HEALTHCHECK CMD php --version