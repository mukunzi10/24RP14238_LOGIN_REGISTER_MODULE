FROM php:8.1-apache

# Install system dependencies and MongoDB extension
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libssl-dev \
    libcurl4-openssl-dev \
    pkg-config \
    && pecl install mongodb \
    && docker-php-ext-enable mongodb \
    && rm -rf /var/lib/apt/lists/*

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy application files
COPY ./src /var/www/html

# Install PHP dependencies defined in composer.json
RUN composer install --no-interaction --prefer-dist

# Enable Apache mod_rewrite and set permissions
RUN a2enmod rewrite && chown -R www-data:www-data /var/www/html

EXPOSE 80

CMD ["apache2-foreground"]
