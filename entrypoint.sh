#!/bin/bash

if [ ! -f "vendor/autoload.php" ]
then
    composer install --no-progress --no-interaction
fi

if [ ! -f ".env" ]
then
    echo "Creating env file for $APP_ENV"
    cp .env.example .env
    php artisan key:generate
else
    echo ".env exists"
fi

role=${CONTAINER_APP:-app}

if [ "$role" = "app" ]
then
    php artisan migrate --seed
    php artisan optimize:clear

    npm install -g npm@latest
    npm install
    npm audit fix
    npm run build

    php artisan serve --port=$PORT --host=0.0.0.0 --env=.env
    exec docker-php-entrypoint "$@"
fi

