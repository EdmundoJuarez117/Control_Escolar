<?php

namespace Database\Seeders;
use App\Models\Cplanestudio;

use Illuminate\Database\Seeder;

class CplanestudioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Planes de estudio

      $planestudio = new Cplanestudio();
      //$planestudio->id = "1";
      $planestudio->nombre = "PLAN SOFTWARE";
      $planestudio->nombre_corto = "ISWP";
      $planestudio->estatus = "1";
      $planestudio->num_creditos_total = "9";
      $planestudio->num_creditos_min = "7";
      $planestudio->num_creditos_max = "9";
      $planestudio->idcarrera = "1";
      $planestudio->save();

      $planestudio = new Cplanestudio();
      //$planestudio->id = "2";
      $planestudio->nombre = "PLAN LICENCIATURA EN TERAPIA FISICA";
      $planestudio->nombre_corto = "PLAN LTF";
      $planestudio->estatus = "1";
      $planestudio->num_creditos_total = "9";
      $planestudio->num_creditos_min = "7";
      $planestudio->num_creditos_max = "9";
      $planestudio->idcarrera = "2";
      $planestudio->save();
    }
}
