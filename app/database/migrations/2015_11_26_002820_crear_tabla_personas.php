<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaPersonas extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('personas', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('primer_nombre', 15);
			$table->string('segundo_nombre', 15);
			$table->string('primer_apellido', 15);
			$table->string('segundo_apellido', 15);
			$table->string('cedula', 8);
			$table->integer('sexo_id');
			$table->integer('usuario_id');
			$table->date('fecha_nacimiento');
			
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
		drop_cascade('personas');
	}

}
