# Grab the Apache PHP 8.3 base image
FROM php:8.3-apache AS base

# Switch to root user
USER root

# Create the main apache2 conf file and delete the default
RUN touch /etc/apache2/sites-available/noahhumbert.conf \
    && rm -f /etc/apache2/sites-available/000-default.conf

##
# Package up our code inside artifact
FROM base AS artifact
COPY --chown=www-data:www-data ./ /var/www/noahhumbert.com
# Setup the blank .env file
RUN touch /var/html/noahhumbert.com/.env \
    && chown www-data:www-data /var/www/noahhumbert.com/.env \
    && chmod ug+rw /var/www/noahhumbert.com/.env
    
##
# Build the production environment
FROM artifact as production
# Copy the production apache2 config
COPY ./apache/noahhumbert.prod.conf /etc/apache2/sites-available/noahhumbert.conf
# Switch to www-data
USER www-data
# Install PHP dependencies
RUN composer install --no-dev