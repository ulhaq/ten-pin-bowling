FROM composer as vendor

WORKDIR /tmp/

COPY composer*.json ./

RUN composer install \
    --ignore-platform-reqs \
    --no-interaction \
    --no-plugins \
    --no-scripts \
    --prefer-dist

FROM php:7.4-fpm

RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    locales \
    zip \
    jpegoptim optipng pngquant gifsicle \
    vim \
    unzip \
    git \
    curl \
    libpq-dev

COPY . ./app/

COPY --from=vendor /tmp/vendor ./app/vendor

WORKDIR ./app/

EXPOSE 9000

CMD ["php", "-S", "0.0.0.0:9000", "-t", "./public"]