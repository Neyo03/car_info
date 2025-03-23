FROM php:8.2-fpm

RUN apt-get update && apt-get install -y \
  git \
  && docker-php-ext-install intl pdo pdo_mysql
