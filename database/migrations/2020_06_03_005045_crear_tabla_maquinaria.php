<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaMaquinaria extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('maquinarias', function (Blueprint $table) {
            $table->increments('idMaquinaria');
            $table->string('nombre', 50);
            $table->string('clasificacion', 50);
            $table->string('marca', 50);
            $table->longText('descripcion')->nullable();
            $table->longText('imagen')->nullable();
            $table->unsignedBigInteger('stock');
            $table->float('precioUnitario', 10, 4);
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
        Schema::dropIfExists('maquinaria');
    }
}
