#!/usr/bin/env sh

##############################################################################
##
##  desktop start up script for UN*X
##
##############################################################################

composer install && \
php artisan migrate && \
php artisan db:seed
