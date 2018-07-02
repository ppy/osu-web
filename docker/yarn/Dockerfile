FROM node:alpine

# Fix permission errors

RUN apk update && \
    apk add bash;

RUN chown -R node:node /data && \
    chmod g+rw /data/*;
    