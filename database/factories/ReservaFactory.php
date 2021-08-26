<?php

namespace Database\Factories;

use App\Models\Reserva;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReservaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Reserva::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $date = $this->faker->dateTimeBetween('-2 years', '+4 months', 'America/Santiago');
        return [
            'id_usuario' => $this->faker->numberBetween(1,50),
            'id_paciente' => $this->faker->numberBetween(1,2),
            'fecha_reserva' => \Carbon\Carbon::parse($date)->format('Y-m-d'),
            'hora_reserva' => \Carbon\Carbon::parse($date)->format('Y-m-d  H:i:s'),
            'fecha_hora_reserva' => \Carbon\Carbon::parse($date)->format('Y-m-d  H:i:s'),
            'fecha_hora_reserva_fin' => \Carbon\Carbon::parse($date)->addHour()->format('Y-m-d  H:i:s'),
            'motivo_reserva' => $this->faker->text,
            'cert_alumno_regular' => null,
        ];
    }
}
