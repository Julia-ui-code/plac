<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Eixos;
use App\Models\Cursos;
use App\Models\Materia;

class EixosController extends Controller
{
    private $eixos;
    private $totalPage = 5;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(Eixos $eixos)
    {
        $this->middleware('auth:admin');
        $this->eixos = $eixos;
    }
    public function index()
    {
        $dados = $this->eixos->paginate($this->totalPage);
        foreach($dados as $item){
            $curso = Cursos::find($item->curso_id);
            $item->CursoNome = $curso->curso;  
        }
        return view('eixos', compact('dados'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $curso = Cursos::all();
        return view('novoEixo', compact('curso'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dados = new Eixos();
        $dados->nome_eixo = $request->input('nome_eixo');
        $dados->curso_id = $request->input('curso_id');
        $dados->save();
        return redirect('/eixos');
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
        $dados = Eixos::find($id);
        $curso = Cursos::all();
        $dados->Cursos = $curso;
        if(isset($dados))
            return view('editarEixo', compact('dados'));
        return redirect('/eixos');
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
        $dados = Eixos::find($id);
        if(isset($dados)){
            $dados->nome_eixo = $request->input('nome_eixo');
            $dados->curso_id = $request->input('curso_id');
            $dados->save();
        }
        return redirect('/eixos');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dados = Eixos::find($id);
        if(isset($dados)){
            $materia = Materia::where('eixo_id', '=', $id)->first();
            if(!isset($materia)){
                $dados->delete();
            }else{
                return redirect('/eixos')->with('danger', 'Eixo não pode ser excluído');
            }

        }else{
            return response('Eixo não encontrado', 404);
        }
        return redirect('/eixos');
    }
}
