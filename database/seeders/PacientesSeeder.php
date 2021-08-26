<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Paciente;
use Carbon\Carbon;

class PacientesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->id_users_rol = '3';
        $user->rut_usuario = '16.404.244-K';
        $user->nombre_usuario = 'Alfredo';
        $user->apellido_pat_usuario = 'Lorenzini';
        $user->apellido_mat_usuario = 'Git';
        $user->sexo = 'Masculino';
        $user->telefono = '993085203';
        $user->email = 'paciente@gmail.com';
        $user->password = bcrypt('redhot1991');
        $user->formacion = 'Ninguna';
        $user->fecha_nacimiento = Carbon::create('1992', '08', '12');
        $user->save();

        $user = new User();
        $user->id_users_rol = '3';
        $user->rut_usuario = '21.236.532-2';
        $user->nombre_usuario = 'Ninoska';
        $user->apellido_pat_usuario = 'Zamudio';
        $user->apellido_mat_usuario = 'Hub';
        $user->sexo = 'Femenino';
        $user->telefono = '945085265';
        $user->email = 'paciente2@gmail.com';
        $user->password = bcrypt('redhot1991');
        $user->formacion = 'Ninguna';
        $user->fecha_nacimiento = Carbon::create('1999', '12', '01');
        $user->save();

        $paciente = new Paciente();
        $paciente->id_psicologo = rand(1,50);
        $paciente->rut_paciente = '16.404.244-K';
        $paciente->nombre_paciente = 'Alfredo';
        $paciente->ap_pat_paciente = 'Lorenzini';
        $paciente->ap_mat_paciente = 'Git';
        $paciente->sexo_paciente = 'Masculino';
        $paciente->profesion = 'Ingeniero';
        $paciente->telefono_paciente = '993085203';
        $paciente->email = 'paciente@gmail.com';
        $paciente->fecha_nacimiento_paciente = Carbon::create('1992', '08', '12');
        $paciente->patologias_previas = 'paracetamol';
        $paciente->password = bcrypt('redhot1991');
        $paciente->save();

        $paciente = new Paciente();
        $paciente->id_psicologo = rand(1,50);
        $paciente->rut_paciente = '21.236.532-2';
        $paciente->nombre_paciente = 'Ninoska';
        $paciente->ap_pat_paciente = 'Zamudio';
        $paciente->ap_mat_paciente = 'Hub';
        $paciente->sexo_paciente = 'Femenino';
        $paciente->profesion = 'Estudiante';
        $paciente->telefono_paciente = '945085265';
        $paciente->email = 'paciente2@gmail.com';
        $paciente->fecha_nacimiento_paciente = Carbon::create('1999', '12', '01');
        $paciente->patologias_previas = 'Ninguna';
        $paciente->password = bcrypt('redhot1991');
        $paciente->save();
    }
}
