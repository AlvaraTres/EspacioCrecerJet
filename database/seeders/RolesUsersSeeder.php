<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Roleuser;

class RolesUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role1 = new Roleuser();
        $role1->tipo_usuario = 'Administrador';
        
        $role2 = new Roleuser();
        $role2->tipo_usuario = 'Psicólogo';
        
        $role3 = new Roleuser();
        $role3->tipo_usuario = 'Paciente';

        $role1->save();
        $role2->save();
        $role3->save();
    }
}
