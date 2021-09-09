<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Usuario con el rol de administrador
    $administrador = User::create([
        'name' => 'administrador',
        'email' => 'administrador@gmail.com',
        'password' => bcrypt('12345678')
    ]);
    //Asignar el rol
    $administrador->assignRole('administrador');


    //Usuario con el rol de docente
    $docente = User::create([
        'name' => 'docente',
        'email' => 'docente@gmail.com',
        'password' => bcrypt('12345678')
    ]);

    //Asignar el rol
    $docente->assignRole('docente');

    //Usuario con el rol de alumno
    $alumno = User::create([
        'name' => 'alumno',
        'email' => 'alumno@gmail.com',
        'password' => bcrypt('12345678')
    ]);
    //Asignar el rol
    $alumno->assignRole('alumno');

  }
   
}
