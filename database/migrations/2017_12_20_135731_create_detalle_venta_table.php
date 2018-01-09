<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetalleVentaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_venta', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('id_venta')->unsigned();
            $table->integer('id_articulo')->unsigned();

            $table->integer('cantidad');
            $table->decimal('precio_venta', 11,2);
            $table->decimal('descuento', 11,2);

            $table->timestamps();

            //Relations
            $table->foreign('id_venta')->references('id')->on('venta')
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
        Schema::dropIfExists('detalle_venta');
    }
}
