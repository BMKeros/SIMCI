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


		$this->call('PermisosTableSeeder');
		$this->call('UsuariosTableSeeder');
	}
}

class UsuariosTableSeeder extends Seeder {

    public function run()
    {
    	DB::table('usuarios')->delete();

        $usuario = new Usuario;

        $usuario->usuario = 'simci';
        $usuario->email = 'simci@gmail.com';
        $usuario->password = 'admin';
        $usuario->cod_permiso = 'ad40';

		$usuario->save();
    }
}

class PermisosTableSeeder extends Seeder {


    public function run()
    {
       DB::table('permisos')->delete();

        $campos = array(array('nombre' => 'lectura', 'codigo' => 'ul20', 'descripcion'=> 'solo consultar todas las opciones'),
        	array('nombre' => 'escritura', 'codigo' => 'ue21', 'descripcion'=> 'hacer cambios a ciertas opciones'),
        	array('nombre' => 'lectura', 'codigo' => 'ule4', 'descripcion'=> 'realizar consultas y cambios a ciertas opciones del sistema'),
        	array('nombre' => 'lectura', 'codigo' => 'ad40', 'descripcion'=> 'permisos para leer, escribir, actualizar y eliminar todas las opciones del sistema'),
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

*/
