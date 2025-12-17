# Grab the Apache PHP 8.3 base image
FROM php:8.3-apache AS base

# Switch to root user
USER root

# Create the main apache2 conf file and delete the default
COPY ./apache/noahhumbert.conf /etc/apache2/sites-available/noahhumbert.conf
RUN rm -f /etc/apache2/sites-available/000-default.conf

##
# Package up our code inside artifact
FROM base AS artifact
# Switch to root user
USER root
# Copy the code to the proper directory
COPY --chown=www-data:www-data ./ /var/www/noahhumbert.com
# Moving working directory to the codebase
WORKDIR /var/www/noahhumbert.com
# Setup Composer
RUN apt-get update \
    && apt-get install -y unzip git \
    && php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php composer-setup.php --install-dir=/usr/local/bin --filename=composer \
    && php -r "unlink('composer-setup.php');"
# Setup the blank .env file
RUN touch .env \
    && chown www-data:www-data .env \
    && chmod ug+rw .env
# Switch to www-data
USER www-data

##
# Build the dev environment
FROM artifact AS test
# Switch to root user
USER root
# Enable the apache config, configure git for the directory, and install php dependencies
RUN a2ensite noahhumbert.conf \
    && git config --global --add safe.directory /var/www/noahhumbert.com \
    && composer install 
# Run apache2
CMD ["apache2-foreground"]
# Switch to www-data
USER www-data

##
# Build the dev environment
FROM artifact AS dev
# Switch to root user
USER root
# Enable the apache config, configure git for the directory, and install php dependencies
RUN a2ensite noahhumbert.conf \
    && git config --global --add safe.directory /var/www/noahhumbert.com \
    && composer install
# Run apache2
CMD ["apache2-foreground"]
# Switch to www-data
USER www-data

##
# Build the production environment
FROM artifact AS prod
# Switch to root user
USER root
# Enable the apache config, configure git for the directory, install php dependencies, Give www-data permission to manipulate all files
RUN a2ensite noahhumbert.conf \
    && git config --global --add safe.directory /var/www/noahhumbert.com \
    && composer install --no-dev
# Run apache2
CMD ["apache2-foreground"]
# Switch to www-data
USER www-data
