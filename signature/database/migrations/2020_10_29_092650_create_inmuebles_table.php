<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInmueblesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inmuebles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre',100);
            $table->string('ubicacion',500);
            $table->string('balcon',10);
            $table->string('estacionamiento',10);
            $table->string('lavado',10);
            $table->integer('nhabitacion');
            $table->integer('nbaño');
            $table->integer('ncama');
            $table->string('area',100);
            $table->string('estado',20);
            $table->double('precio');
            $table->string('imagen')->nullable();
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
        Schema::dropIfExists('inmuebles');
    }
}
