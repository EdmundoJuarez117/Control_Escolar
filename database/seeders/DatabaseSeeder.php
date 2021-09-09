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
        // \App\Models\User::factory(10)->create();
        $this->call(RolesAndPermissions::class);//Llamado al seeder de Roles y permisos
        $this->call(UsersTableSeeder::class);//Llamado al seeder de usuarios
        $this->call(CmodalidadSeeder::class);//Llamado al seeder de modalidades
        $this->call(CcarreraSeeder::class);//Llamado al seeder de carreras
        $this->call(CplanestudioSeeder::class);//Llamado al seeder de plan de estudios
        $this->call(CescalaevalSeeder::class);//Llamado al seeder de plan de estudios
        
        
        //$this->call(CescalaevalSeeder::class);//Llamado al seeder de escalaeval
    }
}
