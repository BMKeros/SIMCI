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
			$table->string('cod_dimension', 4);
			$table->string('cod_subdimension', 3);
			$table->string('cod_agrupacion', 3);
			$table->string('cod_subagrupacion', 3);
			$table->integer('numero_orden');
			$table->integer('cod_objeto');
			$table->decimal('cantidad_disponible');
			$table->boolean('usa_recipientes');
			$table->boolean('stock')->default(false);
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
