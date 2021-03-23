<?php

namespace Database\Seeders;
use App\Models\Eixos;
use Illuminate\Database\Seeder;

class EixosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Eixos::create([
            "nome_eixo" => "Matemática",
            "curso_id" => 1
         ]);
         Eixos::create([
            "nome_eixo" => "Cálculo",
            "curso_id" => 1
         ]);
         Eixos::create([
            "nome_eixo" => "Programação",
            "curso_id" => 1
         ]);
    }
}
