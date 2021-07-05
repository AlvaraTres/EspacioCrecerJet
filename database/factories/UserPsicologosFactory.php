<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserPsicologosFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id_users_rol' => 2,
            'rut_usuario' => '1.111.111-1',
            'nombre_usuario' => $this->faker->name(),
            'apellido_pat_usuario' => $this->faker->lastname(),
            'apellido_mat_usuario' => $this->faker->lastname(),
            'telefono' => $this->faker->e164PhoneNumber(),
            'email' => $this->faker->email(),
            'especialidad' => $this->faker->randomElement('adicciones' , 'coach' , 'duelo' , 'Problemas de autoestima'),
            'fecha_nacimiento' => $this->faker->dateTime(),
            'password' => bcrypt('123456'),

        ];
    }
}
