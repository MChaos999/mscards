FROM php:7.4-fpm

RUN apt-get update \
  && docker-php-ext-install pdo pdo_mysql \
    && docker-php-ext-enable pdo_mysql

#MAINTAINER bodarev <schopenhauer07@gmail.com>
