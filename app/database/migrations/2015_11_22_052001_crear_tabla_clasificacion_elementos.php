<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaClasificacionElementos extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('clasificacion_elementos', function(Blueprint $table)
		{
			$table->integer('cod_clasificacion');
			$table->primary('cod_clasificacion');
			$table->string('descripcion', 25);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		drop_cascade('clasificacion_elementos');
	}

}
