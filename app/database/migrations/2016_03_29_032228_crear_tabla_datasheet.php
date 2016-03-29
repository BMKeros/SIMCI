<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaDatasheet extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('datasheet', function($table)
		{
			$table->increments('id');
			$table->string('nombre', 25);
			$table->string('codigo', 15);
			$table->string('n.cas', 15);
			$table->string('fabricante', 25);
			$table->string('formula', 25);
			$table->float('peso_formula', 5, 2);
			$table->string('informacion_toxica', 150);
			$table->string('informacion_radiactiva', 150);
			$table->string('informacion_fisica_visual', 150);
			$table->string('informacion_proteccion_personal', 150);
			$table->string('informacion_almacenamiento', 150);
			$table->string('informacion_fuego', 150);
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
		Schema::drop('datasheet');
	}

}
