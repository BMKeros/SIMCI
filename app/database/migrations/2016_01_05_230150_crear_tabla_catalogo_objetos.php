<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaCatalogoObjetos extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('catalogo_objetos', function($table)
		{
			$table->increments('id');
			$table->string('nombre',100);
			$table->string('descripcion',200);
			$table->string('especificaciones',200);
			$table->integer('cod_unidad');
			$table->integer('cod_clase_objeto');
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
		drop_cascade('catalogo_objetos');
	}

}
