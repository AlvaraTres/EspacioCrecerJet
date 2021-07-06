<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleSeeder::class);
        $this->call(RolesUsersSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(PacientesSeeder::class);
        \App\Models\User::factory(50)->create();
        //$this->call(UserPsicologosSeeder::class);
    }
}
