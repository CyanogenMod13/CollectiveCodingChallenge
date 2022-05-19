#!/usr/bin/env sh

##############################################################################
##
##  desktop start up script for UN*X
##
##############################################################################

echo 'Starting setup...'

docker-compose up -d --build && \
docker-compose run --rm php-fpm sh ./setup/setup-php.sh && \
docker-compose run --rm node sh ./../setup/setup-node.sh && \
docker-compose down

echo 'Done'
