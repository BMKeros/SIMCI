#!/bin/bash

clear

echo "Ejecutando clear-compiled"
php artisan clear-compiled

echo "Ejecutando optimize"
php artisan optimize

echo "Ejecutando dumpautoload"
composer dumpautoload

echo "Migraciones listas"
echo "Adios"