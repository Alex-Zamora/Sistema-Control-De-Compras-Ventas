<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('persona', function (Blueprint $table) {
            $table->increments('id');

            $table->string('tipo_persona', 50);
            $table->string('nombre', 128);
            $table->string('tipo_documento', 128);
            $table->string('num_documento', 50);
            $table->string('direccion', 128)->nullable();
            $table->string('telefono', 50)->nullable();
            $table->string('email', 128)->nullable();

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
        Schema::dropIfExists('persona');
    }
}
