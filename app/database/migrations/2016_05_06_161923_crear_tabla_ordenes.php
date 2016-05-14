<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaOrdenes extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ordenes', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('codigo', 10);			
			$table->integer('responsable');
			$table->integer('solicitante');
			$table->date('fecha_actividad');
			$table->date('fecha');
			$table->time('hora');
			$table->string('cod_laboratorio', 4);
			$table->string('observaciones', 200);
			$table->string('status', 3);
            

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
		Schema::drop_cascade('ordenes');
	}

}
