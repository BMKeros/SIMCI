#!/bin/bash

echo "Entrando carpeta public"
cd public

echo "Creando archivos compilados (controladores)"
gulp compilar_archivos_angular

echo "Finalizado.."
