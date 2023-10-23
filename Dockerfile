# PHP
FROM php:8.2 as php

RUN apt-get update -y
RUN apt-get install -y unzip libpq-dev libcurl4-gnutls-dev
RUN docker-php-ext-install pdo pdo_mysql bcmath

RUN pecl install -o -f redis \
    && rm -rf /tmp/pear \
    && docker-php-ext-enable redis

RUN curl -sL https://deb.nodesource.com/setup_18.x | bash
RUN apt install nodejs -y
            

WORKDIR /var/www
COPY . .

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

ENV PORT=8000

RUN chmod +x entrypoint.sh

ENTRYPOINT [ "bash", "entrypoint.sh" ]

# *************************************************************************************
# Node

FROM node:latest as node

WORKDIR /var/www
COPY . .

RUN npm install --global cross-env
RUN npm install
RUN npm run build

VOLUME /var/www/node_modules
