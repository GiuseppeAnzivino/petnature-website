FROM php:8.2-apache
RUN apt-get update \
    && apt-get install -y libpq-dev \
    && docker-php-ext-install pgsql pdo_pgsql \
    && rm -rf /var/lib/apt/lists/*
RUN echo "output_buffering=4096" > /usr/local/etc/php/conf.d/output-buffering.ini
