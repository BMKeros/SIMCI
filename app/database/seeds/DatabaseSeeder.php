<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		$this->call('UsuarioTableSeeder');
	}
}

class UsuarioTableSeeder extends Seeder {

    public function run()
    {
        $usuario = new Usuario;

        $usuario->usuario = 'ivantelix';
        $usuario->email = 'ivantelix@gmail.com';
        $usuario->password = 'iseedeadpeople';
        $usuario->cod_permiso = 'ad40';

		$usuario->save();
    }
}

class UsuarioTableSeeder extends Seeder {

    public function run()
    {
       DB::table('permisos')->delete();

        $campos = array(array('nombre' => 'lectura', 'cod_permiso' => 'ul20', 'descripcion'=> 'solo consultar todas las opciones'),
        	array('nombre' => 'escritura', 'cod_permiso' => 'ue21', 'descripcion'=> 'hacer cambios a ciertas opciones'),
        	array('nombre' => 'lectura', 'cod_permiso' => 'ule4', 'descripcion'=> 'realizar consultas y cambios a ciertas opciones del sistema'),
        	array('nombre' => 'lectura', 'cod_permiso' => 'ad40', 'descripcion'=> 'permisos para leer, escribir, actualizar y eliminar todas las opciones del sistema'),
        );

        DB::table('permisos')->insert($campos);
    }
}

/*
class AlmacenTableSeeder extends Seeder {

    public function run()
    {
       DB::table('almacenes')->delete();

        $campos = array(array('cod_almacen' => '', 'id_responsable' => '', 'descripcion'=> ''),
        );

        DB::table('almacenes')->insert($campos);
    }
}

*7
