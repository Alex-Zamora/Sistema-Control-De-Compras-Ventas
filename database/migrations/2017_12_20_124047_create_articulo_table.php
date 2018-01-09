<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticuloTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articulo', function (Blueprint $table) {
            $table->increments('id');

            //unsigned() no permite num negativos
            $table->integer('id_categoria')->unsigned();
            $table->string('codigo', 128)->nullable(); 
            $table->string('nombre', 128);
            $table->integer('stock');
            $table->text('descripcion');
            $table->string('imagen', 128)->nullable();
            $table->string('estado', 50)->nullable();

            $table->timestamps();

            //Relations
            $table->foreign('id_categoria')->references('id')->on('categoria')
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
        Schema::dropIfExists('articulo');
    }
}
