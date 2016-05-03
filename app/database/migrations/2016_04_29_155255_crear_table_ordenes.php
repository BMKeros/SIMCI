<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTableOrdenes extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ordenes', function(Blueprint $table)
		{
			$table->string('codigo', 5);
			$table->primary('codigo');
			
			$table->integer('usuario_id');
			$table->date('fecha');
			$table->time('hora');
			$table->string('cod_laboratorio', 4);
			$table->string('observaciones', 200);
			$table->integer('status');
            

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
		Schema::drop('ordenes');
	}

}
