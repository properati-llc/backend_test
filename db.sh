#!/bin/sh

docker exec -it casafy-app php artisan migrate:install
docker exec -it casafy-app php artisan migrate
docker exec -it casafy-app php artisan db:seed