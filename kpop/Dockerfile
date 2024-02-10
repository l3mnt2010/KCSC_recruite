FROM php:7.4-apache

RUN apt-get update && apt-get install cron -y
RUN docker-php-ext-install mysqli
RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"
RUN a2enmod rewrite

WORKDIR /var/www/html

COPY flag.txt /
COPY hint.txt /hint_to_get_flag.txt
COPY ./src /var/www/html/

EXPOSE 80

COPY ./clean.sh /
COPY ./entrypoint.sh /bin/entrypoint

RUN chmod +x /clean.sh
RUN chmod +x /bin/entrypoint

ENTRYPOINT [ "entrypoint" ]
