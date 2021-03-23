<?php

namespace Database\Seeders;
use App\Models\Cursos;
use Illuminate\Database\Seeder;

class CursosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Cursos::create([
            "curso" => "Engenharia Civil",
            "qnt_periodos" => 2,
            "horas_materias" => 3125,
            "horas_estagio" => 320,
            "horas_ativ" => 190
         ]);
         Cursos::create([
            "curso" => "Medicina",
            "qnt_periodos" => 3,
            "horas_materias" => 4000,
            "horas_estagio" => 120,
            "horas_ativ" => 100
         ]);
    }
}
