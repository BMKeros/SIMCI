<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaUsuarios extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('usuarios', function(Blueprint $table)
		{

			$table->increments('id');
			$table->string('usuario',15)->unique();
			$table->string('email', 60)->unique();
			$table->string('password');
			$table->string('cod_tipo_usuario',4);
			$table->string('imagen',100)->default('/');
			$table->boolean('activo')->default(true);
			$table->rememberToken();
			$table->nullableTimestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		drop_cascade('usuarios');
	}

}
