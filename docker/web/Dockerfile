FROM php:5.6.32-apache
COPY ./php.ini /usr/local/etc/php/
COPY ./apache/*.conf /etc/apache2/sites-enabled/

RUN apt-get update \
  && apt-get install --no-install-recommends -y libpq-dev libonig-dev git zip unzip \
  && apt-get clean \
  && rm -rf /var/cache/apt

RUN docker-php-ext-install pdo pdo_pgsql

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
ENV COMPOSER_ALLOW_SUPERUSER 1 \
  COMPOSER_HOME /composer \
  PATH $PATH:/composer/vendor/bin

WORKDIR /var/www/html

RUN mv /etc/apache2/mods-available/rewrite.load /etc/apache2/mods-enabled
RUN /bin/sh -c a2enmod rewrite