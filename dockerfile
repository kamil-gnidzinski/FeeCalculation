FROM php:8.2-fpm

RUN apt-get update && apt-get install -y \
    git \
    curl \
    unzip \
    libzip-dev \
    && docker-php-ext-install zip \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN chmod +x /usr/local/bin/composer
RUN composer --version  # Optional, for debugging

COPY .env /app/.env