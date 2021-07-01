<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIncluyenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incluyen', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_tag_trastorno');
            $table->unsignedBigInteger('id_ficha_paciente');
            $table->timestamps();

            $table->foreign('id_tag_trastorno')->references('id')->on('tag_trastorno_mental')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('id_ficha_paciente')->references('id')->on('fichas_pacientes')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('incluyen');
    }
}
