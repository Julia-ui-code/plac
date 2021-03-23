<?php

namespace App\Http\Controllers;

use App\Cursos;
use App\Models\Cursos as ModelsCursos;
use App\Models\Eixos;
use App\Models\Materia;
use Curso;
use Illuminate\Http\Request;

class CursoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function index()
    {
        $curso = ModelsCursos::all() ;
        return view('curso', compact('curso')) ;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('novoCurso');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $dados = new ModelsCursos();
        $dados->curso = $request->input('nomeCurso');
        $dados->qnt_periodos = $request->input('qnt_periodos');
        $dados->horas_materias = $request->input('horas_materias');
        $dados->horas_estagio = $request->input('horas_estagio');
        $dados->horas_ativ = $request->input('horas_ativ');
        $dados->save();
        return redirect('/curso');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dados = ModelsCursos::find($id);
        if(isset($dados))
            return view('editarCurso', compact('dados'));
        return redirect('/curso');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $dados = ModelsCursos::find($id);
        if(isset($dados)){
            $dados->curso = $request->input('nomeCurso');
            $dados->qnt_periodos = $request->input('qnt_periodos');
            $dados->horas_materias = $request->input('horas_materias');
            $dados->horas_estagio = $request->input('horas_estagio');
            $dados->horas_ativ = $request->input('horas_ativ');
            $dados->save();
        }
        return redirect('/curso');   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {  
        $dados = ModelsCursos::find($id);
        if(isset($dados)){
            $eixos = Eixos::where('curso_id', '=', $id)->first();
            if(!isset($eixos)){
            $dados->delete();
            }else{
                return redirect('/curso')->with('danger', 'Curso não pode ser excluído');
            }
        }else{
            return response('Curso não encontrado', 404);
        }
        return redirect('/curso');
    }
}
