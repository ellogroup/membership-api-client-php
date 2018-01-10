FROM diningclub/docker-base-alpine-php7:1.0.11

RUN apk add --no-cache --repository http://dl-3.alpinelinux.org/alpine/edge/main \
        git
