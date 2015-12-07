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
		Schema::create('almacenes', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('cod_almacen');
			$table->integer('responsable');
			$table->integer('primer_auxiliar');
			$table->integer('segundo_auxiliar');
			$table->string('descripcion', 8);
			
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
		Schema::drop('almacenes');
	}

}
