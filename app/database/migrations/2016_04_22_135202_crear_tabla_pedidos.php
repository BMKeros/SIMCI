<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaPedidos extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pedidos', function($table)
		{
			$table->increments('id');
			$table->string('codigo_pedido', 5);
			$table->integer('usuario_id');
			$table->date('fecha');
			$table->time('hora');
			$table->string('cod_laboratorio', 4);
			$table->integer('numero_orden');
			$table->decimal('cantidad_solicitada');

			//estos son los primary
			$table->string('cod_dimension', 4);
			$table->string('cod_subdimension', 3);
			$table->string('cod_agrupacion', 3);
			$table->string('cod_subagrupacion', 3)->nullable();


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
		Schema::drop('pedidos');
	}

}
