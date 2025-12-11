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
# Copy the code to the proper directory
COPY --chown=www-data:www-data ./ /var/www/noahhumbert.com
# Moving working directory to the codebase
WORKDIR /var/www/noahhumbert.com
# Setup the blank .env file
RUN touch .env \
    && chown .env \
    && chmod ug+rw .env

##
# Build the dev environment
FROM artifact as dev
# Dev Environment Variables
ENV APP_ENV=dev \
    APP_DEBUG=1
# Copy the dev apache2 config
COPY ./apache/noahhumbert.conf /etc/apache2/sites-available/noahhumbert.conf
# Switch to root user
USER root
# Enable the apache config and install php dependencies
RUN a2ensite noahhumbert.conf \
    && composer install
# Switch to www-data
USER www-data

##
# Build the production environment
FROM artifact as prod
# Prod Environment Variables
ENV APP_ENV=prod \
    APP_DEBUG=0
# Copy the production apache2 config
COPY ./apache/noahhumbert.conf /etc/apache2/sites-available/noahhumbert.conf
# Switch to root user
USER root
# Enable the apache config and install php dependencies
RUN a2ensite noahhumbert.conf \
    && composer install --no-dev
# Switch to www-data
USER www-data
