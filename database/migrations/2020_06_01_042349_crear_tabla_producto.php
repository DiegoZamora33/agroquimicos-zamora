<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaProducto extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->increments('idProducto');
            $table->string('nombre', 50);
            $table->string('clasificacion', 50);
            $table->string('ingredienteActivo', 50);
            $table->string('marca', 50);
            $table->longText('descripcion')->nullable();
            $table->longText('formaAplicacion')->nullable();
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
        Schema::dropIfExists('producto');
    }
}
