FROM alpine:latest

RUN apk add --update yarn bash shadow

ARG _uid
ARG _gid

ENV _uid ${_uid}
ENV _gid ${_gid}

COPY setup.sh /

RUN /setup.sh
