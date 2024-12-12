FROM php:8.3-fpm

RUN apt-get update && apt-get install -y \
      apt-utils \
      libpq-dev \
      libpng-dev \
      libzip-dev \
      zip unzip \
      git && \
      docker-php-ext-install pdo_mysql && \
      docker-php-ext-install bcmath && \
      docker-php-ext-install gd && \
      docker-php-ext-install zip && \
      apt-get clean && \
      rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

COPY ./_docker/app/php.ini /usr/local/etc/php/conf.d/php.ini

# Install composer
ENV COMPOSER_ALLOW_SUPERUSER=1
RUN curl -sS https://getcomposer.org/installer | php -- \
    --filename=composer \
    --install-dir=/usr/local/bin

WORKDIR /var/www

# Согласуем пользователя www-data
RUN usermod -u 1000 www-data && groupmod -g 1000 www-data

# Устанавливаем права на /var/www и storage
RUN mkdir -p /var/www/storage && \
    chown -R www-data:www-data /var/www && \
    chown -R www-data:www-data /var/www/storage && \
    chmod -R 775 /var/www/storage


# Переключаемся на пользователя www-data
USER www-data

CMD ["php-fpm"]
