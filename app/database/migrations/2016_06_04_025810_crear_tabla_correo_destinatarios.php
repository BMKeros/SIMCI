<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaCorreoDestinatarios extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('correo_destinatarios', function ($table) {
            $table->increments('id');
            $table->integer('correo_id');
            $table->integer('destinatario');
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
        drop_cascade('correo_destinatarios');
    }

}
