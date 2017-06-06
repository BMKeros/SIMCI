#!/bin/bash

#Carpeta para los archivos de usuario
mkdir -p public/uploads/imagenes/
chown -R www-data:www-data public/uploads/imagenes/

#Carpeta para los archivos envidos por correo de la app
mkdir -p public/uploads/archivos/correo
chown -R www-data:www-data public/uploads/archivos/correo/
