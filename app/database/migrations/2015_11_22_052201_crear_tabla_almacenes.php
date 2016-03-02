<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaAlmacenes extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('almacenes', function($table)
		{
			$table->string('codigo',4);
			$table->integer('responsable');
			$table->integer('primer_auxiliar')->nullable();
			$table->integer('segundo_auxiliar')->nullable();
			$table->string('descripcion', 150);

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
		drop_cascade('almacenes');
	}

}
