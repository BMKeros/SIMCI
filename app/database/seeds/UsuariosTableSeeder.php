<?php

class UsuariosTableSeeder extends Seeder {

    public function run()
    {
    	DB::table('usuarios')->delete();

        $usuario = new Usuario;

        $usuario->usuario = 'simci';
        $usuario->email = 'simci@gmail.com';
        $usuario->password = 'admin';
        $usuario->cod_permiso= 'AD40';
        $usuario->cod_tipo_usuario = 'TU01';
        
		$usuario->save();
    }
}