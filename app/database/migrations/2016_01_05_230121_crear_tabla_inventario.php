<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaInventario extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('inventario', function($table)
		{
			$table->increments('id');
			$table->integer('cod_dimension');
			$table->integer('cod_subdimension');
			$table->integer('cod_agrupacion');
			//$table->integer('cod_subagrupacion');
			$table->integer('numero_orden');
			$table->integer('cod_objeto');
			$table->decimal('cantidad_disponible');
			$table->boolean('usa_recipientes');
			$table->integer('recipientes_disponibles');
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
		drop_cascade('inventario');
	}

}
