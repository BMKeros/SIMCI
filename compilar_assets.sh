#!/bin/bash

echo "Entrando carpeta public"
cd public

echo "Creando archivos compilados (controladores)"
gulp crear_controladores

echo "Finalizado.."
