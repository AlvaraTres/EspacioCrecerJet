<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePacientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pacientes', function (Blueprint $table) {
            $table->id();
            $table->string('rut_paciente', 12)->unique();
            $table->string('nombre_paciente');
            $table->string('ap_pat_paciente');
            $table->string('ap_mat_paciente');
            $table->string('profesion');
            $table->string('telefono_paciente', 12);
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->date('fecha_nacimiento_paciente');
            $table->string('alergia');
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('pacientes');
    }
}
