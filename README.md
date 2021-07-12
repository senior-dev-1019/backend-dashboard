
## About Install

## install dependencies
composer install

## configure the settings.
copy .env.example .env

## setup database and import dummy datas for a test
php artisan migrate

php artisan db:seed

## setup jwt
php artisan jwt:secret

## Run the project
php artisan serve
