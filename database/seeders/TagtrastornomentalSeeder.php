<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tagtrastornomental;

class TagtrastornomentalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tag = new Tagtrastornomental();
        $tag->nombre_tag = 'Trastorno depresivo mayor';
        $tag->descripcion = 'Trastorno de salud mental que se caracteriza por depresión persistente o pérdida de interés en las actividades, lo que puede causar dificultades significativas en la vida cotidiana.';
        $tag->save();

        $tag = new Tagtrastornomental();
        $tag->nombre_tag = 'Trastorno de ansiedad';
        $tag->descripcion = 'Trastorno mental que se caracteriza por producir sensaciones de preocupación, ansiedad o miedo, tan fuertes que interfieren con las actividades diarias de quien las padece.';
        $tag->save();

        $tag = new Tagtrastornomental();
        $tag->nombre_tag = 'Trastorno bipolar';
        $tag->descripcion = 'Trastorno que provoca altibajos emocionales, que van desde trastornos de depresión hasta episodios maníacos.';
        $tag->save();

        $tag = new Tagtrastornomental();
        $tag->nombre_tag = 'Demencia';
        $tag->descripcion = 'La demencia no es una enfermedad específica, sino un grupo de trastornos caracterizados por el deterioro de, al menos, dos funciones cerebrales, como la memoria y la razón.
        Los síntomas incluyen olvidos, aptitudes sociales restringidas y razonamiento tan limitado que interfiere en las actividades diarias.';
        $tag->save();
    }
}
