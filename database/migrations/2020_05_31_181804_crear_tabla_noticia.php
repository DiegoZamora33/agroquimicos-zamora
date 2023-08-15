<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaNoticia extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('noticias', function (Blueprint $table) {
            $table->increments('idNoticia');
            $table->string('titulo', 50);
            $table->longText('texto')->nullable();
            $table->longText('imagen')->nullable();   
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
        Schema::dropIfExists('noticia');
    }
}
