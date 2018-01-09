<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIngresoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ingreso', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('id_proveedor')->unsigned();
            $table->string('tipo_comprobante', 50);
            $table->string('serie_comprobante', 50)->nullable();
            $table->string('num_comprobante');
            $table->decimal('impuesto', 4,2);
            $table->string('estado', 50);

            $table->timestamps();

            //Relation
            $table->foreign('id_proveedor')->references('id')->on('persona')
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
        Schema::dropIfExists('ingreso');
    }
}
