# Use official PHP Apache image
FROM php:7.4-apache

# Copy your app source code into Apache web root
COPY . /var/www/html/

# Enable Apache mod_rewrite if your app needs it
RUN a2enmod rewrite

# Expose port 80 inside container (default)
EXPOSE 80
