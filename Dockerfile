FROM php:8.3-fpm

RUN apt-get update && apt-get install -y \
        nginx \
        supervisor \
        libssl-dev \
        ca-certificates \
        curl \
    && docker-php-ext-install pdo pdo_mysql mysqli \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

RUN mkdir -p /run/php \
    && chown www-data:www-data /run/php

RUN rm -f /usr/local/etc/php-fpm.d/www.conf
COPY zz-docker.conf /usr/local/etc/php-fpm.d/zz-docker.conf

RUN rm -f /etc/nginx/sites-enabled/default \
    && rm -f /etc/nginx/conf.d/default.conf
COPY nginx/default.conf /etc/nginx/conf.d/ems.conf

COPY supervisord.conf /etc/supervisor/conf.d/supervisord.conf

COPY . /var/www/html/
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

EXPOSE 80

CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]
