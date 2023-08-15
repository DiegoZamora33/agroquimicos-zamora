<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaAsesoria extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asesorias', function (Blueprint $table) {
            $table->increments('idAsesoria');
            $table->string('nombre', 50);
            $table->string('telefono', 50);
            $table->string('correo', 50)->nullable(); 
            $table->longText('texto');  
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
        Schema::dropIfExists('asesoria');
    }
}
