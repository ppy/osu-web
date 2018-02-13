FROM phpdockerio/php71-fpm:latest

RUN apt-get update \
    && apt-get -y --no-install-recommends install \
        php7.1-curl \
        php7.1-gd \
        php7.1-intl \
        php7.1-json \
        php7.1-mbstring \
        php7.1-mcrypt \
        php7.1-mysql \
        php7.1-xml \
        php7.1-zip

ARG _uid
ARG _gid

ENV _uid ${_uid}
ENV _gid ${_gid}

COPY setup.sh /data/

RUN ./data/setup.sh
