# Use the official PHP image with Apache
FROM php:8.2-apache

# Set working directory
WORKDIR /var/www/html

# Install system dependencies and PHP extensions in a single layer
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    locales \
    zip \
    jpegoptim optipng pngquant gifsicle \
    vim \
    unzip \
    git \
    curl \
    libonig-dev \
    libxml2-dev \
    libzip-dev && \
    docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip && \
    a2enmod rewrite && \
    a2enmod remoteip && \
    apt-get clean && rm -rf /var/lib/apt/lists/*

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy application files and set permissions in one step
COPY . /var/www/html
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache && \
    mv /var/www/html/.env.docker /var/www/html/.env && \
    composer install --no-dev --optimize-autoloader && \
    rm /var/www/html/.env

# Copy custom Apache configuration file
COPY ./apache/laravel.conf /etc/apache2/sites-available/000-default.conf

# Enable mod_rewrite and disable default site
RUN a2enmod rewrite

# Expose port 80 for Apache
EXPOSE 80

# Start Apache server
CMD ["apache2-foreground"]

# Metadata
LABEL authors="CloudTheWolf"
