FROM php:8.1-fpm-alpine

WORKDIR /var/www

RUN apk add --no-cache \
    bash curl git unzip zip libzip-dev libpng-dev libjpeg-turbo-dev \
    freetype-dev oniguruma-dev icu-dev libxml2-dev autoconf \
    g++ make \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) \
        pdo \
        pdo_mysql \
        mbstring \
        exif \
        pcntl \
        bcmath \
        zip \
        gd \
    && apk del autoconf g++ make

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

COPY --chown=www-data:www-data . .

RUN composer install --no-interaction --prefer-dist --optimize-autoloader

RUN chmod -R 755 /var/www/storage

EXPOSE 9000

CMD ["php-fpm"]
