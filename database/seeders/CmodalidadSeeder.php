<?php

namespace Database\Seeders;
use App\Models\Cmodalidad;

use Illuminate\Database\Seeder;

class CmodalidadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Modalidades
      $modalidad = new Cmodalidad();
      $modalidad->nombre = "ESCOLARIZADA";
      $modalidad->save();

      $modalidad = new Cmodalidad();
      $modalidad->nombre = "MIXTA";
      $modalidad->save();
    }
}
