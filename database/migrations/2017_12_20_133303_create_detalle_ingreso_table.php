<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetalleIngresoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_ingreso', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('id_ingreso')->unsigned();
            $table->integer('id_articulo')->unsigned();

            $table->integer('cantidad');
            $table->decimal('precio_comrpa', 11,2);
            $table->decimal('precio_venta', 11,2);

            $table->timestamps();

            //Relations
            $table->foreign('id_ingreso')->references('id')->on('ingreso')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('id_articulo')->references('id')->on('articulo')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detalle_ingreso');
    }
}
