<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaEntradasInventario extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('entradas_inventario', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('id_proveedor', 5);
			$table->integer('id_usuario');
			$table->integer('cod_objeto');
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
		Schema::drop('entradas_inventario');
	}

}
