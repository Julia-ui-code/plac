<?php

namespace App\Http\Controllers;

use App\User;
use App\Models\Admin as ModelsAdmin;
use App\Models\User as ModelsUser;
use Illuminate\Http\Request;

class AlunoController extends Controller
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
        $alunos = ModelsUser::all() ;
        return view('alunos', compact('alunos')) ;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $dados = new ModelsUser();
        $dados->name= $request->input('name');
        $dados->email = $request->input('email');
        $dados->save();
        return redirect('/alunos');
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {  
        $dados = ModelsUser::find($id);
        $adm = new ModelsAdmin();
        $adm->name = $dados->name;
        $adm->email = $dados->email;
        $adm->password = $dados->password;
        $adm->save();
        if(isset($dados)){
            $dados->delete();
        }else{
            return response('Aluno não encontrado', 404);
        }
        return redirect('/alunos');
    }
}
