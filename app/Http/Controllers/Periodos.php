<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Materia;
use PDF;

class Periodos extends Controller
{   
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        return view('periodos');
    }
    public function pdf($id){
        $id_periodo = $id;
        //pegando as coisas do materias users daquele periodo especifico
        $dados = DB::table('materia_users')
                    ->select('*')
                    ->where('periodo_id', '=', $id_periodo)
                    ->get();
        foreach($dados as $it){
            $oi = $it->fazer;
        }
        $fazer = explode(',', $oi);
        $mat = array();
        //colocando as linhas das materias escolhodas pra fazer
        foreach($fazer as $fa){
            $dados2 = Materia::where('id', '=', $fa)->first(); 
            array_push($mat, $dados2); 
        }
        $totalhoras = 0;
        foreach($fazer as $fa){
            $totalhoras += Materia::where('id', '=', $fa)->sum('horas');
        }
        $pdf = PDF::loadview('periodopdf',compact('mat', 'totalhoras', 'id_periodo'));
        return $pdf->download('PeriodoPDF.pdf');
    }
}
?>