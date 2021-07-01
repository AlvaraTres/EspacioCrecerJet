<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFichasPacientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fichas_pacientes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_usuario');
            $table->unsignedBigInteger('id_paciente');
            $table->date('fecha_atencion_ficha');
            $table->text('resumen_atencion');
            $table->timestamps();

            $table->foreign('id_usuario')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('id_paciente')->references('id')->on('pacientes')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fichas_pacientes');
    }
}
