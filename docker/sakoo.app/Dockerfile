FROM php:8.1.14-fpm-alpine
LABEL MAINTAINER="Pouya Asgharnejad Tehran | https://sakoo.dev"

RUN apk update \
&& apk upgrade \
&& apk add --update git curl zip unzip nodejs npm linux-headers $PHPIZE_DEPS

RUN pecl install inotify-3.0.0 && docker-php-ext-enable inotify \
&& pecl install xdebug && docker-php-ext-enable xdebug \
&& docker-php-ext-install pdo_mysql mysqli

RUN echo "xdebug.mode=develop,coverage,debug,gcstats,profile,trace" >> /usr/local/etc/php/conf.d/xdebug.ini \
&& echo "xdebug.start_with_request=yes" >> /usr/local/etc/php/conf.d/xdebug.ini \
&& echo "xdebug.discover_client_host=1" >> /usr/local/etc/php/conf.d/xdebug.ini \
&& echo "xdebug.client_host=host.docker.internal" >> /usr/local/etc/php/conf.d/xdebug.ini

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer

WORKDIR /var/www/html/

HEALTHCHECK CMD php --version