<?php

namespace Database\Seeders;
use App\Models\Cescalaeval;
use Illuminate\Database\Seeder;

class CescalaevalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Modalidades de la carrera
      $escalaeval = new Cescalaeval();
      $escalaeval->nombre = "Presencial Software";
      $escalaeval->calificacion_min = "7";
      $escalaeval->calificacion_max = "9";
      $escalaeval->save();

      $escalaeval = new Cescalaeval();
      $escalaeval->nombre = "Online Software";
      $escalaeval->calificacion_min = "6";
      $escalaeval->calificacion_max = "8";
      $escalaeval->save();
    }
}
