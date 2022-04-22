FROM php:7.4-fpm as base
RUN apt-get update && apt-get install -y zlib1g-dev g++ git libicu-dev zip libzip-dev zip \
    && docker-php-ext-install intl opcache pdo pdo_mysql \
    && pecl install apcu \
    && docker-php-ext-enable apcu \
    && docker-php-ext-configure zip \
    && docker-php-ext-install zip
WORKDIR /var/www
#############################################################################################################
FROM base as local-dev
# Install composer
RUN pecl install xdebug \
    && docker-php-ext-enable xdebug
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
#############################################################################################################
# Builder for dev
FROM base as builder-dev
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
ADD composer.lock .
ADD composer.json .
RUN composer install --no-interaction --no-scripts
ADD . .
#############################################################################################################
FROM base AS dev
COPY --from=builder-dev --chown=www-data:www-data /var/www /opt/app
#############################################################################################################
# Builder for staging
FROM base as builder
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
ADD composer.lock .
ADD composer.json .
RUN composer install --no-dev --optimize-autoloader --prefer-dist  --no-scripts
ADD . .
#############################################################################################################
FROM base AS prod
# @TODO needs review
COPY --from=builder --chown=www-data:www-data /var/www /opt/app
#############################################################################################################
FROM php:7.4-cli as php-cli 
RUN apt-get update && apt-get install -y zlib1g-dev g++ git libicu-dev zip libzip-dev zip \
    && docker-php-ext-install intl opcache pdo pdo_mysql \
    && pecl install apcu \
    && docker-php-ext-enable apcu \
    && docker-php-ext-configure zip \
    && docker-php-ext-install zip
WORKDIR /var/www
#############################################################################################################
FROM php-cli as prod-worker
COPY ./docker/php/entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh
COPY --from=builder --chown=www-data:www-data /var/www /var/www
ENTRYPOINT ["/entrypoint.sh"]
#############################################################################################################
FROM php-cli as dev-worker
COPY ./docker/php/entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh
COPY --from=builder-dev --chown=www-data:www-data /var/www /var/www
ENTRYPOINT ["/entrypoint.sh"]
