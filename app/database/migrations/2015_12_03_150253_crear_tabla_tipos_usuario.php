<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaTiposUsuario extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tipos_usuario', function($table)
		{
			$table->string('codigo',4);
			$table->string('nombre', 15);
			$table->string('descripcion',50);

			$table->increments('secuencia');
			$table->dropPrimary('secuencia');

			$table->primary('codigo');

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
		drop_cascade('tipos_usuario');
	}

}
