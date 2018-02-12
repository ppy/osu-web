FROM phpdockerio/php72-fpm:latest

RUN apt-get update \
    && apt-get -y --no-install-recommends install \
        php7.2-curl \
        php7.2-gd \
        php7.2-intl \
        php7.2-json \
        php7.2-mbstring \
        php7.2-mysql \
        php7.2-xml \
        php7.2-zip

ARG _uid
ARG _gid

ENV _uid ${_uid}
ENV _gid ${_gid}

COPY setup.sh /data/

RUN ./data/setup.sh
