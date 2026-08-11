# Use official PHP 8.2 with Apache
FROM php:8.2-apache

# Enable Apache mod_rewrite for LavaLust URL routing
RUN a2enmod rewrite

# Set Apache document root to LavaLust's public folder
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public

# Update Apache virtual host configuration
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' \
    /etc/apache2/sites-available/*.conf

# Update Apache main configuration
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' \
    /etc/apache2/apache2.conf \
    /etc/apache2/conf-available/*.conf

# Allow .htaccess files to override Apache settings
RUN sed -i 's/AllowOverride None/AllowOverride All/g' \
    /etc/apache2/apache2.conf

# Copy LavaLust project into the container
COPY . /var/www/html

# Set working directory
WORKDIR /var/www/html

# Set permissions for LavaLust directories
RUN chown -R www-data:www-data \
    /var/www/html/runtime \
    /var/www/html/app \
    /var/www/html/public

# Expose HTTP port
EXPOSE 80

# Start Apache using Render's PORT environment variable
CMD sed -i "s/80/${PORT}/g" \
    /etc/apache2/ports.conf \
    /etc/apache2/sites-enabled/000-default.conf \
    && apache2-foreground