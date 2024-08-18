FROM php:8.3.10-fpm-alpine
LABEL MAINTAINER="Pouya Asgharnejad Tehran | https://sakoo.dev"

RUN apk add --no-cache git curl zip unzip nodejs npm linux-headers $PHPIZE_DEPS

RUN pecl install inotify-3.0.0 && docker-php-ext-enable inotify \
&& pecl install xdebug && docker-php-ext-enable xdebug \
&& docker-php-ext-install pdo_mysql mysqli

COPY ./docker/sakoo.app/xdebug.ini /tmp/xdebug.ini
RUN cat /tmp/xdebug.ini >> /usr/local/etc/php/conf.d/xdebug.ini && rm /tmp/xdebug.ini

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN chown -R www-data:www-data /var/www/html/
WORKDIR /var/www/html/
USER www-data:www-data

HEALTHCHECK --interval=30s --timeout=10s --start-period=5s --retries=3 CMD pgrep php-fpm || exit 1

EXPOSE 9000

CMD ["php-fpm"]