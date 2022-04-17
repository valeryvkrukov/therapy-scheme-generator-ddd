FROM php:8.1-fpm

RUN apt update \
    && apt install -y zlib1g-dev g++ git libicu-dev zip libzip-dev librabbitmq-dev zip \
    #&& git clone --branch master --depth 1 https://github.com/php-amqp/php-amqp.git /usr/src/php/ext/amqp \
    #&& cd /usr/src/php/ext/amqp && git submodule update --init \
    && docker-php-ext-install intl opcache pdo pdo_mysql \
    && pecl install apcu \
    && pecl install amqp \
    && docker-php-ext-enable apcu \
    #&& docker-php-ext-configure amqp \
    && docker-php-ext-enable amqp \
    && docker-php-ext-configure zip \
    && docker-php-ext-install zip

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN curl -sS https://get.symfony.com/cli/installer | bash
RUN mv /root/.symfony/bin/symfony /usr/local/bin/symfony
RUN git config --global user.email "valery.v.krukov@gmail.com.com" \
    && git config --global user.name "Valery Krukov"

WORKDIR /var/www/application