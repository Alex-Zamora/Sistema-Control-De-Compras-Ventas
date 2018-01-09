<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVentaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('venta', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('id_cliente')->unsigned();
            // $table->integer('id_usuario')->unsigned();

            $table->string('tipo_comprobante', 50);
            $table->string('serie_comprobante', 50)->nullable();
            $table->string('num_comprobante', 50);
            $table->decimal('impuesto', 4,2);
            $table->decimal('total_venta', 11,2);
            $table->string('estado', 50);

            $table->timestamps();

            //Relations
            $table->foreign('id_cliente')->references('id')->on('persona')
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
        Schema::dropIfExists('venta');
    }
}
