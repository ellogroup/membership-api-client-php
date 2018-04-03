FROM diningclub/docker-base-alpine-php7:3.0.0
COPY . /app
WORKDIR /app
RUN rm -rf vendor && composer install --ignore-platform-reqs
