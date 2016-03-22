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
			$table->string('cod_dimension', 4);
			$table->string('cod_subdimension', 3);
			$table->string('cod_agrupacion', 3);
			$table->string('cod_subagrupacion', 3)->nullable();
			$table->integer('numero_orden');
			$table->integer('cod_objeto');
			$table->decimal('cantidad_disponible');
			$table->boolean('usa_recipientes');
			$table->boolean('elemento_movible')->default(false);
			$table->integer('recipientes_disponibles')->nullable();
			$table->nullableTimestamps();

			//Constrains
			$table->primary(array('cod_dimension','cod_subdimension','cod_agrupacion','cod_objeto'));
			$table->unique(array('cod_dimension','cod_subdimension','cod_agrupacion','cod_objeto'));

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
