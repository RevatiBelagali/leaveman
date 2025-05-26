# Use official PHP Apache image
FROM php:7.4-apache

# Set working directory to avoid copying system files
WORKDIR /var/www/html

# Copy only needed files
COPY . .

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Clean up apt cache if you add apt packages later (good habit)
# RUN apt update && apt install -y <packages> && rm -rf /var/lib/apt/lists/*

# Expose port 80
EXPOSE 80
