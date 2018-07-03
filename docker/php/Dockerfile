FROM php:7.1-fpm-alpine

RUN apk update && \
    apk add \
    php7-curl \
    php7-gd \
    php7-intl \
    php7-json \
    php7-mbstring \
    php7-mcrypt \
    php7-xml \
    php7-zip;

# WORKAROUND For https://github.com/docker-library/php/issues/279
RUN docker-php-ext-install mysqli


RUN addgroup -g 1000 php \
&& adduser -u 1000 -G php -s /bin/sh -D php;
