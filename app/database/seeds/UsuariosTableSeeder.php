<?php

class UsuariosTableSeeder extends Seeder {

    public function run()
    {
    	DB::table('usuarios')->delete();

        $usuario = new Usuario;

        $usuario->usuario = 'simci';
        $usuario->email = 'simci@gmail.com';
        $usuario->password = 'admin';
        $usuario->permiso_id = '4';
        $usuario->tipo_usuario = '1';
        
		$usuario->save();
    }
}