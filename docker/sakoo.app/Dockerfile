FROM php:8.2.12-fpm-alpine
LABEL MAINTAINER="Pouya Asgharnejad Tehran | https://sakoo.dev"

RUN apk add --no-cache git curl zip unzip nodejs npm linux-headers $PHPIZE_DEPS

RUN pecl install inotify-3.0.0 && docker-php-ext-enable inotify \
&& pecl install xdebug && docker-php-ext-enable xdebug \
&& docker-php-ext-install pdo_mysql mysqli

RUN echo "xdebug.mode=develop,coverage,debug,gcstats,profile,trace" >> /usr/local/etc/php/conf.d/xdebug.ini \
&& echo "xdebug.start_with_request=yes" >> /usr/local/etc/php/conf.d/xdebug.ini \
&& echo "xdebug.discover_client_host=1" >> /usr/local/etc/php/conf.d/xdebug.ini \
&& echo "xdebug.client_host=host.docker.internal" >> /usr/local/etc/php/conf.d/xdebug.ini

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN chown -R www-data:www-data /var/www/html/
WORKDIR /var/www/html/
USER www-data:www-data

HEALTHCHECK --interval=30s --timeout=10s --start-period=5s --retries=3 CMD pgrep php-fpm || exit 1

EXPOSE 9000

CMD ["php-fpm"]