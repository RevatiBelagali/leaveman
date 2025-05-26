FROM php:7.4-apache

# Install mysqli and enable it
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli

# Enable mod_rewrite
RUN a2enmod rewrite

# Set working directory and copy files
WORKDIR /var/www/html
COPY . .

EXPOSE 80
