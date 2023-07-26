FROM php:5.6-fpm-alpine

RUN #apk add composer
RUN apk add nginx
RUN ["mkdir", "/var/www/steam"]

WORKDIR /var/www/steam
COPY . .
#COPY /docker/default /etc/nginx/sites-available/

EXPOSE 80
EXPOSE 8080
EXPOSE 443

