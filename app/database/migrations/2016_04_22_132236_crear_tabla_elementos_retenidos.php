<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaElementosRetenidos extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('elementos_retenidos', function(Blueprint $table)
		{
			$table->increments('id');
			$table->decimal('cantidad_existente');
			$table->decimal('cantidad_solicitada');
			$table->integer('cod_referencia');//codigo que referenciara a Elem-Ret;Pedido
			$table->integer('cod_tipo_movimiento');
			$table->integer('numero_orden');

			//estos son los primary
			$table->string('cod_dimension', 4);
			$table->string('cod_subdimension', 3);
			$table->string('cod_agrupacion', 3);
			$table->integer('cod_objeto');

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
		Schema::drop('elementos_retenidos');
	}

}
