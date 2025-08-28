FROM php:8.2-fpm

# Install system dependencies and PHP extensions
RUN apt-get update && apt-get install -y \
  libpq-dev \
  libzip-dev \
  zip \
  unzip \
  git \
  curl \
  libonig-dev \
  libxml2-dev \
  libssl-dev \
  libcurl4-openssl-dev \
  pkg-config \
  libjpeg-dev \
  libpng-dev \
  libfreetype6-dev \
  && docker-php-ext-configure gd --with-jpeg --with-freetype \
  && docker-php-ext-install pdo pdo_mysql gd mbstring zip bcmath \
  && pecl install redis && docker-php-ext-enable redis \
  && apt-get clean && rm -rf /var/lib/apt/lists/*

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy application
COPY . /var/www

# Permissions
RUN chown -R www-data:www-data /var/www \
  && find /var/www -type f -exec chmod 644 {} \; \
  && find /var/www -type d -exec chmod 755 {} \;

WORKDIR /var/www/public