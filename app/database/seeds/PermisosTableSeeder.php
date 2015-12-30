<?php

class PermisosTableSeeder extends Seeder {


    public function run()
    {
       DB::table('permisos')->delete();

        $campos = array(
        	array('nombre' => 'lectura', 'codigo' => 'UL20', 'descripcion'=> 'solo consultar todas las opciones'),
            array('nombre' => 'escritura', 'codigo' => 'UE21', 'descripcion'=> 'hacer cambios a ciertas opciones'),
            array('nombre' => 'lectura', 'codigo' => 'ULE4', 'descripcion'=> 'realizar consultas y cambios a ciertas opciones del sistema'),
            array('nombre' => 'ROOT', 'codigo' => 'AD40', 'descripcion'=> 'permisos para leer, escribir, actualizar y eliminar todas las opciones del sistema'),
        );

        DB::table('permisos')->insert($campos);
    }
}