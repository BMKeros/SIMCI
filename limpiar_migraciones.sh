#!/bin/bash

clear

echo "Ejecutando clear-compiled"
php artisan clear-compiled

echo "Ejecutando optimize"
php artisan optimize

echo "Ejecutando dumpautoload"
composer dumpautoload

echo "Rollback"
php artisan migrate:rollback

echo "Migrate"
php artisan migrate

echo "Refresh y Seed"
php artisan migrate:refresh --seed

echo "Migraciones listas"
echo "Adios"