<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Eixos;
use App\Models\Cursos;
use App\Models\Materia;

class MateriaController extends Controller
{
    private $materias;
    private $totalPage = 5;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(Materia $materia)
    {
        $this->middleware('auth:admin');
        $this->materias = $materia;
    }
    public function index()
    {
        $dados = $this->materias->paginate($this->totalPage);
        foreach ($dados as $item) {
            $eixos = Eixos::find($item->eixo_id);
            $item->nome_eixo = $eixos->nome_eixo;
            $curso = Cursos::find($eixos->curso_id);
            $item->CursoNome = $curso->curso;
        }
        return view('materias', compact('dados'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $eixos = Eixos::all();
        $curso = Cursos::all();
        $materias = Materia::all();
        return view('novaMateria', compact('eixos', 'curso', 'materias'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dados = new Materia();
        $dados->curso_id = $request->input('curso_id');
        $dados->eixo_id = $request->input('eixo_id');
        $dados->nome_materia = $request->input('nome_materia');
        $pre_req_array = $request->get('pre_req');
        if(isset($pre_req_array)){
            $pre_req_string = implode(",", $pre_req_array);
            $dados->pre_req = $pre_req_string;
        }else{
            $dados->pre_req = "";
        }
        $co_req_array = $request->get('co_req');
        if(isset($co_req_array)){
            $co_req_string = implode(",", $co_req_array);
            $dados->co_req = $co_req_string;
        }else{
            $dados->co_req = "";
        }
        $dados->horas = $request->input('horas');
        $dados->cat = $request->input('cat');
        $dados->indice = $request->input('indice');
        $dados->save();
        return redirect('/materias');
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
        $dados = Materia::find($id);
        $eixos = Eixos::all();
        $curso = Cursos::all();
        $materias = Materia::all();
        $dados->Eixos = $eixos;
        $dados->Cursos = $curso;
        $dados->Materia = $materias;
        $ids_pre = explode(",", $dados->pre_req);
        $ids_co = explode(",", $dados->co_req);
        if (isset($dados))
            return view('editarMateria', compact('dados', 'ids_pre', 'ids_co'));
        return redirect('/materias');
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
        $dados = Materia::find($id);
        if (isset($dados)) {
            $dados->curso_id = $request->input('curso_id');
            $dados->eixo_id = $request->input('eixo_id');
            $dados->nome_materia = $request->input('nome_materia');
            $pre_req_array = $request->get('pre_req');
        if(isset($pre_req_array)){
            $pre_req_string = implode(",", $pre_req_array);
            $dados->pre_req = $pre_req_string;
        }else{
            $dados->pre_req = "";
        }
        $co_req_array = $request->get('co_req');
        if(isset($co_req_array)){
            $co_req_string = implode(",", $co_req_array);
            $dados->co_req = $co_req_string;
        }else{
            $dados->co_req = "";
        }
            $dados->horas = $request->input('horas');
            $dados->cat = $request->input('cat');
            $dados->indice = $request->input('indice');
            $dados->save();
        }
        return redirect('/materias');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dados = Materia::find($id);
        if (isset($dados)) {
            $dados->delete();
        }else{
            return response('Matéria não encontrada', 404);
        }
        return redirect('/materias');
    }
}
