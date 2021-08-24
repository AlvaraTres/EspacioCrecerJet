<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_users_rol');
            $table->string('rut_usuario', 12)->unique();
            $table->string('nombre_usuario');
            $table->string('apellido_pat_usuario');
            $table->string('apellido_mat_usuario');
            $table->string('telefono', 12);
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('especialidad');
            $table->date('fecha_nacimiento');
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('id_users_rol')->references('id')->on('roles_users')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
