# Use an official PHP runtime as a parent image with Apache
FROM php:8.1.0-apache
COPY .htaccess /var/www/html/.htaccess
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf
COPY apache.conf /etc/apache2/conf-available/
RUN a2enconf apache
# Set working directory
WORKDIR /var/www/html

# Install extensions
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Copy the current directory contents into the container at /var/www/html
COPY . /var/www/html

# Expose port 80 to allow communication to/from server
EXPOSE 80

# Give ownership of the directory to the www-data user
RUN chown -R www-data:www-data /var/www/html

# Enable Apache mod_rewrite
RUN a2enmod rewrite