<?php

class TiposUsuarioTableSeeder extends Seeder {

    public function run()
    {
       DB::table('tipos_usuario')->delete();

        $campos = array(
        	array('codigo' => TIPO_USER_ROOT, 'nombre' => 'Root', 'descripcion' => 'Root'),
        	array('codigo' => TIPO_USER_ADMIN, 'nombre' => 'Administrador', 'descripcion' => 'Administrador'),
        	array('codigo' => TIPO_USER_PROFESOR, 'nombre' => 'Profesor', 'descripcion' => 'Profesor'),
        	array('codigo' => TIPO_USER_ESTUDIANTE, 'nombre' => 'Estudiante', 'descripcion' => 'Estudiante'),
        	array('codigo' => TIPO_USER_ALMACENISTA, 'nombre' => 'Almacenista', 'descripcion' => 'Almacenista'),
        	array('codigo' => TIPO_USER_SUPERVISOR, 'nombre' => 'Supervisor', 'descripcion' => 'Supervisor'),
        );

        DB::table('tipos_usuario')->insert($campos);
    }
}
