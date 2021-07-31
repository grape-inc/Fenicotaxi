FROM php:7.2-cli
ADD https://raw.githubusercontent.com/mlocati/docker-php-extension-installer/master/install-php-extensions /usr/local/bin/
RUN chmod uga+x /usr/local/bin/install-php-extensions && sync && \
    install-php-extensions pdo_mysql
RUN mkdir /usr/src/app
WORKDIR /usr/src/app
COPY laravel_entrypoint.sh /usr/src/app
CMD chmod +x puma_entrypoint.sh