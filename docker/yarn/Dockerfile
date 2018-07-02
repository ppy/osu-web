FROM node:alpine

# Fix permission errors

RUN apk update && \
    apk add bash;

RUN mkdir -p /data && \
    mkdir -p /data/osu-web && \
    chown -R node:node /data && \
    chmod g+rw /data/*;
    