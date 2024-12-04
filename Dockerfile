FROM php:8.1-fpm

# Установка необходимых зависимостей
RUN apt-get update && apt-get install -y \
    curl \
    git \
    unzip \
    && rm -rf /var/lib/apt/lists/*

# Установка Composer
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

# Установка необходимых расширений PHP
RUN docker-php-ext-install pdo pdo_mysql

WORKDIR /var/www/html
