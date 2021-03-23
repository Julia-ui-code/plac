<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Materia;
use App\Models\Cursos;

class Simulador extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index($id){
        $dados = Materia::all();
        $dados_hr = Cursos::find($id);
        $horas_totais = $dados_hr->horas_materias + $dados_hr->horas_estagio + $dados_hr->horas_ativ;
        return view('simulador', compact('dados', 'horas_totais'));
    }
}
