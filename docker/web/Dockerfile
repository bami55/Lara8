FROM php:8.0.0-apache-buster

SHELL ["/bin/bash", "-oeux", "pipefail", "-c"]

COPY ./php.ini /usr/local/etc/php/
COPY ./*.conf /etc/apache2/sites-enabled/

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

ENV COMPOSER_ALLOW_SUPERUSER 1 \
  COMPOSER_HOME /composer

RUN apt-get update && \
  apt-get -y install git zlib1g-dev libpq-dev libicu-dev libonig-dev libzip-dev unzip locales && \
  apt-get clean && \
  rm -rf /var/lib/apt/lists/* && \
  mkdir /var/run/php-fpm && \
  mkdir /var/log/php && \
  docker-php-ext-install intl pdo pdo_pgsql zip bcmath && \
  composer config -g process-timeout 3600 && \
  composer config -g repos.packagist composer https://packagist.org

WORKDIR /var/www/html
