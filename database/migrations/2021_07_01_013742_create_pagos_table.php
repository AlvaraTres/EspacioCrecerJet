<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_reserva');
            $table->unsignedBigInteger('id_paciente');
            $table->dateTime('fecha_pago');
            $table->integer('monto_pago');
            $table->timestamps();

            $table->foreign('id_reserva')->references('id')->on('reservas')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('pagos');
    }
}
