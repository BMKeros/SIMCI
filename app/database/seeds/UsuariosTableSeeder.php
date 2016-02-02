<?php

class UsuariosTableSeeder extends Seeder {

    public function run()
    {
    	DB::table('usuarios')->delete();

        $usuario = new Usuario;

        $usuario->usuario = 'simci';
        $usuario->email = 'simci@gmail.com';
        $usuario->password = 'admin';
        $usuario->cod_tipo_usuario = TIPO_USER_ROOT;
        
		$usuario->save();

        $usuario = new Usuario;

        $usuario->usuario = 'profesor';
        $usuario->email = 'profesor@gmail.com';
        $usuario->password = 'profesor';
        $usuario->cod_tipo_usuario = TIPO_USER_PROFESOR;
        
        $usuario->save();

        $usuario = new Usuario;

        $usuario->usuario = 'supervisor';
        $usuario->email = 'supervisor@gmail.com';
        $usuario->password = 'supervisor';
        $usuario->cod_tipo_usuario = TIPO_USER_SUPERVISOR;
        
        $usuario->save();

        $usuario = new Usuario;

        $usuario->usuario = 'almacenista';
        $usuario->email = 'almacenista@gmail.com';
        $usuario->password = 'almacenista';
        $usuario->cod_tipo_usuario = TIPO_USER_ALMACENISTA;
        
        $usuario->save();
    }
}