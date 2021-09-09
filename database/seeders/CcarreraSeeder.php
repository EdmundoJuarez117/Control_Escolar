<?php

namespace Database\Seeders;
use App\Models\Ccarrera;
use Illuminate\Database\Seeder;


class CcarreraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Carreras
        
        $carrera = new Ccarrera();
        
        $carrera->nombre = "Ingeniería en Software";
        $carrera->nombre_corto = "ISW";
        $carrera->estatus = "1";
        $carrera->idmodalidad = "1";
        $carrera->save();

        $carrera = new Ccarrera();
        $carrera->nombre = "Licenciatura en Terapia Física";
        $carrera->nombre_corto = "LTF";
        $carrera->estatus = "1";
        $carrera->idmodalidad = "1";
        $carrera->save();
    }
}
