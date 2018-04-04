<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEquipamientoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equipamiento', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('aula_id');
            $table->string('nombre');
            $table->integer('cantidad');
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
        Schema::dropIfExists('equipamiento');
    }
}
