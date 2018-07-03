FROM node:alpine

# Fix permission errors

RUN mkdir -p data && \
    chown -R node:node /data && \
    chmod g+rw /data;
    