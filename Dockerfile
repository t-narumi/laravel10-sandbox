# syntax=docker/dockerfile:1

FROM php:8.2-cli-bookworm

# System deps needed for common Laravel tooling and PHP extensions
RUN apt-get update \
    && apt-get install -y --no-install-recommends \
        ca-certificates \
        curl \
        git \
        unzip \
        libzip-dev \
        libonig-dev \
        libxml2-dev \
    && rm -rf /var/lib/apt/lists/*

# PHP extensions: make sure MySQL (PDO) is available
RUN docker-php-ext-install -j$(nproc) \
        pdo_mysql \
        mbstring \
        zip \
        xml

# Install Composer (copy from official image)
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Laravel's built-in server
EXPOSE 8000
