<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_usuario');
            $table->unsignedBigInteger('id_paciente');
            $table->date('fecha_reserva');
            $table->dateTime('hora_reserva');
            $table->dateTime('fecha_hora_reserva');
            $table->dateTime('fecha_hora_reserva_fin');
            $table->text('motivo_reserva')->nullable();
            $table->string('cert_alumno_regular')->nullable();
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
        Schema::dropIfExists('reservas');
    }
}
