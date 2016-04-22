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
			$table->decimal('cantidad_existente',  5, 2);
			$table->decimal('cantidad_solicitada',  5, 2);
			$table->integer('cod_referencia');//codigo que referenciara a Elem-Ret;Pedido
			$table->integer('cod_tipo_movimiento');

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
