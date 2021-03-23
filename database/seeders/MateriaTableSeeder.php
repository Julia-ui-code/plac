<?php

namespace Database\Seeders;
use App\Models\Materia;
use Illuminate\Database\Seeder;

class MateriaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Materia::create([
            "curso_id" => 1,
            "eixo_id" => 1,
            "nome_materia" => "Matéria 1",
            "pre_req" => "",
            "co_req" => "",
            "horas" => 55,
            "cat" => "Obrigatória",
            "indice" => 2
         ]);
         Materia::create([
            "curso_id" => 1,
            "eixo_id" => 2,
            "nome_materia" => "Matéria 2",
            "pre_req" => "",
            "co_req" => "",
            "horas" => 55,
            "cat" => "Obrigatória",
            "indice" => 2
         ]);
         Materia::create([
             "curso_id" => 1,
            "eixo_id" => 3,
            "nome_materia" => "Matéria 3",
            "pre_req" => "",
            "co_req" => "",
            "horas" => 55,
            "cat" => "Obrigatória",
            "indice" => 2
         ]);
         Materia::create([
            "curso_id" => 1,
            "eixo_id" => 3,
            "nome_materia" => "Matéria 4",
            "pre_req" => "1,2",
            "co_req" => "3,4",
            "horas" => 55,
            "cat" => "Optativa",
            "indice" => 2
         ]);

    }
}
