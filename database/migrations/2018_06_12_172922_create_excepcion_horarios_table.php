<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExcepcionHorariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('excepcion_horarios', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('aula_id');
            $table->string('fecha');
            $table->string('turno');
            $table->unsignedInteger('hora');
            $table->timestamps();


            $table->foreign('aula_id')->references('id')->on('aulas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('excepcion_horarios');
    }
}
