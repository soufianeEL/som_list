#!/bin/sh

php artisan migrate:rollback
php artisan migrate
php artisan db:seed

echo '' > public/nohup.out
echo '' > public/out.txt
