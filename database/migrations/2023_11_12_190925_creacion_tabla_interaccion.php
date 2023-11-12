<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('interaccion', function (Blueprint $table){
            $table->unsignedBigInteger('id_perro_interesado')->required();
            $table->unsignedBigInteger('id_perro_candidato')->required();
            $table->string('preferencia');
            $table->timestamps();

            $table->foreign('id_perro_interesado')->references('id')->on('perro');
            $table->foreign('id_perro_candidato')->references('id')->on('perro');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
