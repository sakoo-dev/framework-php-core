FROM php:8.1.17-fpm-alpine
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

RUN sed -i 's/^pm\.max_children.*/pm.max_children = 10/g' /usr/local/etc/php-fpm.d/www.conf \
&& sed -i 's/^pm\.start_servers.*/pm.start_servers = 3/g' /usr/local/etc/php-fpm.d/www.conf \
&& sed -i 's/^pm\.min_spare_servers.*/pm.min_spare_servers = 2/g' /usr/local/etc/php-fpm.d/www.conf \
&& sed -i 's/^pm\.max_spare_servers.*/pm.max_spare_servers = 4/g' /usr/local/etc/php-fpm.d/www.conf \
&& sed -i 's/^listen\.allowed_clients.*/listen.allowed_clients = 127.0.0.1/g' /usr/local/etc/php-fpm.d/www.conf

RUN chown -R www-data:www-data /var/www/html && chmod -R 755 /var/www/html

WORKDIR /var/www/html/

HEALTHCHECK --interval=30s --timeout=10s --start-period=5s --retries=3 CMD pgrep php-fpm || exit 1

EXPOSE 9000

CMD ["php-fpm"]