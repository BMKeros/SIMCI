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
        Schema::create('datasheets', function ($table)
		{
			$table->increments('id');
            $table->string('nombre', 40);
			$table->string('codigo', 15);
            $table->string('numero_cas', 15);
            $table->string('fabricante', 30);
			$table->string('formula', 25);
			$table->float('peso_formula', 5, 2);
            $table->string('informacion_toxica', 400);
            $table->string('informacion_radiactiva', 400);
            $table->string('informacion_fisica_visual', 400);
            $table->string('informacion_proteccion_personal', 400);
            $table->string('informacion_almacenamiento', 400);
            $table->string('informacion_fuego', 400);
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
        Schema::drop('datasheets');
	}

}

