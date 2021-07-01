<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Carbon\Carbon;

class UserSeeder extends Seeder
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
        $user->rut_usuario = '18.404.255-K';
        $user->nombre_usuario = 'Diego';
        $user->apellido_pat_usuario = 'Alvarado';
        $user->apellido_mat_usuario = 'Salas';
        $user->telefono = '993085203';
        $user->email = 'diego@gmail.com';
        $user->password = bcrypt('redhot1991');
        $user->especialidad = 'Ninguna';
        $user->fecha_nacimiento = Carbon::create('1992', '08', '12');
        $user->save();
    }
}
