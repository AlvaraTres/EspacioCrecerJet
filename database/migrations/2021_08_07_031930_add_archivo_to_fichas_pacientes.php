<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddArchivoToFichasPacientes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('fichas_pacientes', function (Blueprint $table) {
            $table->string('archivo', 250)->nullable()->after('resumen_atencion');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('fichas_pacientes', function (Blueprint $table) {
            $table->dropColumn('archivo');
        });
    }
}
