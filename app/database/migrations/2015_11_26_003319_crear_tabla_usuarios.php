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
			$table->string('usuario')->unique();
			$table->string('email', 60)->unique();
			$table->string('password');
			$table->integer('permiso_id');
			$table->integer('tipo_usuario');
			$table->string('imagen',20);
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
