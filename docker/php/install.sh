#!/bin/sh

cd /usr/src/app
composer install
php artisan migrate:fresh --seed