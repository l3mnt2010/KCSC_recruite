FROM php:8.2-apache

RUN apt-get update && apt-get install inetutils-ping dnsutils -y

WORKDIR /var/www/html/
COPY ./src .
COPY flag.txt /8051757494_flag_5519766868.txt

# config permission
RUN chown -R root:www-data /var/www/html
RUN chmod 750 /var/www/html
RUN find . -type f -exec chmod 640 {} \;
RUN find . -type d -exec chmod 750 {} \;
RUN chmod g+w /var/www/html