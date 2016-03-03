<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaSalidasInventario extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('salidas_inventario', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('id_usuario');
			$table->integer('id_objeto');
			$table->decimal('cantidad');
			$table->time('hora');
			$table->date('fecha');
			$table->string('observaciones', 200);
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
		Schema::drop('salidas_inventario');
	}

}
