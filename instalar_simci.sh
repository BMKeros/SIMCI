#!/bin/bash

clear
instalar_node=false
instalar_npm=false

verificar_node=$(ls /usr/bin /usr/sbin /usr/local/bin | grep "node")
verificar_npm=$(ls /usr/bin /usr/sbin /usr/local/bin | grep "npm")
verificar_composer=$(composer -v)

#echo "$verificar_node"
#echo "$verificar_npm"

#Verificamos si existe node
if `echo "$verificar_node" | grep "node"  > /dev/null`; then
	instalar_node=false
else
	instalar_node=true
fi

#Verificamos si existe npm
if `echo "$verificar_npm" | grep "npm"  > /dev/null`; then
	instalar_npm=false
else
	instalar_npm=true
fi

#Verificamos si node y npm estan instaladas
if [[ "$instalar_node" == "false" && "$instalar_npm" == "false" ]]; then
	echo continuar con la instalacion
else
	echo error instalar 
fi



