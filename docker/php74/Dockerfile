FROM php:7.4-cli AS base

WORKDIR /app

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    && rm -rf /var/lib/apt/lists/*

FROM base AS composer

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

FROM base AS debug

RUN pecl channel-update pecl.php.net && \
    pecl install xdebug-2.9.8 && \
    docker-php-ext-enable xdebug

WORKDIR /app

CMD ["bash"]