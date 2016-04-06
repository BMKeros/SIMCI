<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaObjetosLaboratorio extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('objetos_laboratorio', function($table)
        {
            $table->increments('id');
            $table->string('cod_laboratorio', 4);
            
            $table->string('cod_dimension', 4);
            $table->string('cod_subdimension', 3);
            $table->string('cod_agrupacion', 3);

            $table->integer('cod_objeto');
            $table->integer('cantidad');
            $table->nullableTimestamps();

            $table->unique(array('cod_objeto','cod_laboratorio','cod_dimension','cod_subdimension','cod_agrupacion'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('objetos_laboratorio');
    }

}
