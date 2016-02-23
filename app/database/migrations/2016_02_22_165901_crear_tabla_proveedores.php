<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaProveedores extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('proveedores', function($table)
		{
			$table->increments('id');
			$table->string('razon_social', 50);
			$table->string('doc_identificacion', 50);
			$table->string('numero_fijo', 20)->nullable();
			$table->string('numero_movil', 20)->nullable();
			$table->string('direccion', 200);
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('proveedores');
	}

}
