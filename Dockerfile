# Use the official PHP image
FROM php:7.4-apache

# Set the working directory in the container
WORKDIR /var/www/html

# Copy the current directory contents into the container at /var/www/html
COPY . /var/www/html

# Install PHP extensions
RUN docker-php-ext-install mysqli

# Start the Apache server
CMD ["apache2-foreground"]