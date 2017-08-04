FROM node:latest

ARG _uid
ARG _gid

ENV _uid ${_uid}
ENV _gid ${_gid}

COPY setup.sh /data/

RUN ./data/setup.sh
