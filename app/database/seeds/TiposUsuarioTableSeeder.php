<?php

class TiposUsuarioTableSeeder extends Seeder {

    public function run()
    {
       DB::table('tipos_usuario')->delete();

        $campos = array(
        	array('codigo' => TIPO_USER_ROOT, 'descripcion' => 'Root'),
        	array('codigo' => TIPO_USER_ADMIN, 'descripcion' => 'Administrador'),
        	array('codigo' => TIPO_USER_PROFESOR, 'descripcion' => 'Profesor'),
        	array('codigo' => TIPO_USER_ESTUDIANTE, 'descripcion' => 'Estudiante'),
        	array('codigo' => TIPO_USER_ALMACENISTA, 'descripcion' => 'Almacenista'),
        	array('codigo' => TIPO_USER_SUPERVISOR, 'descripcion' => 'Supervisor'),
        );

        DB::table('tipos_usuario')->insert($campos);
    }
}
