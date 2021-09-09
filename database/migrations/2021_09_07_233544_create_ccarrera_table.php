<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCcarreraTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('c_carrera', function (Blueprint $table) {
            
            $table->unsignedTinyInteger('id')->autoIncrement();
            $table->string('nombre', 100);
            $table->string('nombre_corto', 10);
            $table->boolean('estatus');
            $table->dateTime('fcreacion', $precision = 0);
            $table->dateTime('fmodificacion', $presicion = 0)->nullable($value = true);    
            $table->unsignedTinyInteger('idmodalidad');
            $table->foreign('idmodalidad')->references('id')->on('c_modalidad');            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('c_carrera');
    }
}
