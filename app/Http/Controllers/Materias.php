<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\MateriaUser;
use App\Models\Materia;
use App\Models\Cursos;
use Illuminate\Support\Facades\Auth;
use Redirect;

class Materias extends Controller
{   
    public function __construct()
    {   
        $this->middleware('auth');
    }
    public function index($id){
        $id_periodo = $id;
        $dados = DB::table('materia_users')
                    ->select('*')
                    ->where('user_id', '=', Auth::user()->id)
                    ->where('periodo_id', '=', $id_periodo)
                    ->first();
        if(isset($dados)){
            $curso = Cursos::find(Auth::user()->curso_id);
            $id_mat_user = $dados->id;
            //pegando as materias que foram colocadas como fazer no materia user e mandando pra view
            $mat_fazer = DB::table('materia_users')
                            ->select('fazer')
                            ->where('periodo_id', '=', $id_periodo)
                            ->where('user_id', '=', Auth::user()->id)
                            ->get();
            //separando o obj em um array de strings
            foreach($mat_fazer as $it){
                $oi = $it->fazer;
            }
            $fazer = explode(',', $oi);
            $fazerr = array();
            //colocando as linhas das materias escolhodas pra fazer
            foreach($fazer as $fa){
                $dados2 = Materia::where('id', '=', $fa)->first(); 
                array_push($fazerr, $dados2); 
            }
            //verificação pra array vazio 
            $vazio = FALSE;
            foreach($fazerr as $v){
                if(!isset($v)){
                    $vazio = TRUE;
                }
            }
            return view('periodos',compact('fazerr', 'id_periodo', 'vazio', 'id_mat_user', 'curso'));
            
        }
        else{
            $conc1 = array();
            $estagio = '';
            $ativs = '';
            if($id_periodo > 1){
                $dados_ant = DB::table('materia_users')
                            ->select('*')
                            ->where('periodo_id', '=', $id_periodo-1)
                            ->where('user_id', '=', Auth::user()->id)
                            ->first();
                $estagio = DB::table('materia_users')
                            ->select('estagio')
                            ->where('estagio', '=', "concluido")
                            ->where('user_id', '=', Auth::user()->id)
                            ->first();
                $ativs = DB::table('materia_users')
                                ->select('ativs')
                                ->where('ativs', '=', "concluido")
                                ->where('user_id', '=', Auth::user()->id)
                                ->first();
                if(isset($dados_ant)){
                    $conc1 = explode(',', $dados_ant->concluido);
                }
            }
            if(isset($conc1)){
                $dados1 = Materia::where('curso_id', Auth::user()->curso_id)->get();
                $curso = Cursos::find(Auth::user()->curso_id);
                foreach($dados1 as $i){
                    //ta peganddo o nome do pre requisito pelo id q foi colocado
                    if($i->pre_req == ""){
                        $i->pre_req = '-';
                    }
                    else{
                    $ids_pre = explode(",", $i->pre_req); //criando um array com os ids de pre requisito
                    $materias = array();
                    foreach($ids_pre as $id){
                            $idd = (int)$id;
                            $nome_materia = DB::table('materias')
                                        ->select('nome_materia')
                                        ->where('id', '=', $idd)
                                        ->get();
                            foreach($nome_materia as $nome){
                                array_push($materias, $nome->nome_materia); //colocando os nomes das materias num array
                            }
                    }
                    $materias1 = implode(" - ", $materias);
                        $i->pre_req = $materias1;
                    }   

                    //ta peganddo o nome do co requisito pelo id q foi colocado
                    if($i->co_req == ""){
                        $i->co_req = '-';
                    }
                    else{
                    $ids_co = explode(",", $i->co_req); //criando um array com os ids de pre requisito
                    $materias_co = array();
                    foreach($ids_co as $id11){
                            $id1 = (int)$id11;
                            $nome_materiaco = DB::table('materias')
                                        ->select('nome_materia')
                                        ->where('id', '=', $id1)
                                        ->get();
                            foreach($nome_materiaco as $nome){
                                array_push($materias_co, $nome->nome_materia); //colocando os nomes das materias num array
                            }
                    }
                    $materias2 = implode(" - ", $materias_co);
                        $i->co_req = $materias2;
                    }   
                }
                $esta = false;
                if($estagio != ''){
                    $esta = true;
                }
                $ativ = false;
                if($ativs != ''){
                    $ativ = true;
                }
                return view('materias_aluno',compact('dados1', 'id_periodo', 'curso', 'conc1', 'esta', 'ativs')); 
            }
            else{
            $dados1 = Materia::where('curso_id', Auth::user()->curso_id)->get();
            $curso = Cursos::find(Auth::user()->curso_id);
            foreach($dados1 as $i){
                //ta peganddo o nome do pre requisito pelo id q foi colocado
                if($i->pre_req == ""){
                    $i->pre_req = '-';
                }
                else{
                   $ids_pre = explode(",", $i->pre_req); //criando um array com os ids de pre requisito
                   $materias = array();
                   foreach($ids_pre as $id){
                        $idd = (int)$id;
                        $nome_materia = DB::table('materias')
                                    ->select('nome_materia')
                                    ->where('id', '=', $idd)
                                    ->get();
                        foreach($nome_materia as $nome){
                            array_push($materias, $nome->nome_materia); //colocando os nomes das materias num array
                        }
                   }
                   $materias1 = implode(" - ", $materias);
                    $i->pre_req = $materias1;
                }   

                //ta peganddo o nome do co requisito pelo id q foi colocado
                if($i->co_req == ""){
                    $i->co_req = '-';
                }
                else{
                   $ids_co = explode(",", $i->co_req); //criando um array com os ids de pre requisito
                   $materias_co = array();
                   foreach($ids_co as $id11){
                        $id1 = (int)$id11;
                        $nome_materiaco = DB::table('materias')
                                    ->select('nome_materia')
                                    ->where('id', '=', $id1)
                                    ->get();
                        foreach($nome_materiaco as $nome){
                            array_push($materias_co, $nome->nome_materia); //colocando os nomes das materias num array
                        }
                   }
                   $materias2 = implode(" - ", $materias_co);
                    $i->co_req = $materias2;
                }   
            }
            
            return view('materias_aluno',compact('dados1', 'id_periodo', 'curso', 'conc1')); 
        }
        }
    }
    public function salvar(Request $request){
        $id_periodo = $request->get('periodo_id');
        $dados = new MateriaUser();
        $dados->user_id = $request->get('user_id');
        $dados->periodo_id = $request->get('periodo_id');
        //colocando o estagio
        $dados->estagio = $request->get('estagio');
        $dados->ativs = $request->get('ativ');
        //pegar o array de string e juntar em uma string so
        $fazer1 = $request->get('fazer');
        if(isset($fazer1)){
            $fazer2 = implode(",", $fazer1);
            $dados->fazer = $fazer2;
        }
        else{
            $dados->fazer = NULL;
        }
        $con1 = $request->get('concluido');
        if(isset($con1)){
            $con2 = implode(",", $con1);
            $dados->concluido = $con2;   
        }
        else{
            $dados->concluido = NULL;
        }
        //salvar no banco de dados
        $dados->save();
        return redirect()->route('periodos', ['id' => $id_periodo]);
        
    }
    public function concluido(Request $request){
        $periodo_id = $request->get("periodo_id");

        $ids = $request->get("con"); //array com os ids das materias q foram colocadas como concluidas
        //pegando os ids do materias user
        $mat_user = array(); //array com as materias q foram colocadas pra fazer anteriormente
        $mat_user1 = DB::table('materia_users')
                            ->select('fazer')
                            ->where('periodo_id', '=', $periodo_id)
                            ->get();
        foreach($mat_user1 as $ma){
            $mat_user = explode(",", $ma->fazer); //transformando em array de string
        }

        if(!empty($ids)){
            $passar = array_intersect($ids, $mat_user); // achar o id q tem nos dois arrays
            foreach($passar as $p){
                $key = array_search($p, $mat_user);
                unset($mat_user[$key]); //apagando o id q é igual nos dois arrays
            }
        }

        if(empty($passar)){ //caso a pessoa tenha colocado q concluiu td vai deleta a linha
            return redirect()->route('periodos', ['id' => $periodo_id]);
        }
        else{ //caso n ira so tirar a materia do fazer 
            $id = DB::table('materia_users')
                ->select('id')
                ->where('periodo_id', '=', $periodo_id)
                ->get(); //pegando o id do materia user pra alterar
            $id1 = 0;
            foreach($id as $i){
                $id1 = $i->id; //colocando em uma variavel pra colocar no find
            }
            $conc = DB::table('materia_users')
                        ->select('concluido')
                        ->where('periodo_id', '=', $periodo_id)
                        ->get();
            $conc1 = "";
            foreach($conc as $c){
                $conc1 = $conc1 . $c->concluido; //pegando os ids q foram colocados como concluido anteriormente
            }
            $passar2 = "";
            foreach($passar as $p){
                $passar2 = implode(",", $passar);//juntando as posições q restaram em uma string pra colocar no banco de dados
            }
            $mat_user_1 = "";
            foreach($mat_user as $m){
                $mat_user_1 = implode(",", $mat_user);//juntando as posições q restaram em uma string pra colocar no banco de dados
            }
            $conc2 = $conc1 . ','. $passar2;
            $dados = MateriaUser::find($id1);
            $dados->fazer = $mat_user_1; //fazer virar string
            $dados->concluido = $conc2;
            $esta = $request->get("estagio");
            if(isset($esta)){
                $dados->estagio = "concluido";
            }
            else{
                $dados->estagio = NULL;
            }
            $ati = $request->get("ativ");
            if(isset($ati)){
                $dados->ativs = "concluido";
            }
            else{
                $dados->ativs = NULL;
            }
            $dados->save();
            return redirect()->route('periodos', ['id' => $periodo_id]);
        }
    }
    public function editar($id){
        $id_mat_user = $id; //pegou o id da linha do materias user pra modificar depois
        //pegar tds as materias do banco de dados pra mostrar na tela
        $dados1 = Materia::all();
        $curso = Cursos::find(Auth::user()->curso_id);
        foreach($dados1 as $i){
            //ta peganddo o nome do pre requisito pelo id q foi colocado
            if($i->pre_req == ""){
                $i->pre_req = '-';
            }
            else{
                $ids_pre = explode(",", $i->pre_req); //criando um array com os ids de pre requisito
                $materias = array();
                foreach($ids_pre as $id){
                    $idd = (int)$id;
                    $nome_materia = DB::table('materias')
                                ->select('nome_materia')
                                ->where('id', '=', $idd)
                                ->get();
                    foreach($nome_materia as $nome){
                        array_push($materias, $nome->nome_materia); //colocando os nomes das materias num array
                    }
                }
                $materias1 = implode(" - ", $materias);
                $i->pre_req = $materias1;
            }   

            //ta peganddo o nome do co requisito pelo id q foi colocado
            if($i->co_req == ""){
                $i->co_req = '-';
            }
            else{
                $ids_co = explode(",", $i->co_req); //criando um array com os ids de pre requisito
                $materias_co = array();
                foreach($ids_co as $id11){
                    $id1 = (int)$id11;
                    $nome_materiaco = DB::table('materias')
                                ->select('nome_materia')
                                ->where('id', '=', $id1)
                                ->get();
                    foreach($nome_materiaco as $nome){
                        array_push($materias_co, $nome->nome_materia); //colocando os nomes das materias num array
                    }
                }
                $materias2 = implode(" - ", $materias_co);
                $i->co_req = $materias2;
            }   
        }

        //pegando os ids das materias q foram colocadas no fazer e no concluido pra ja deixar checado e facilitar a vida do usuario

        $ids_dados = MateriaUser::where('id', $id_mat_user)->first();
        $fazer = explode(',', $ids_dados->fazer);
        $conc = explode(',', $ids_dados->concluido);
        $estagio = $ids_dados->estagio;
        $ativs = $ids_dados->ativs;
        //returnando tds as materias e o id da linha na tabela materias user pra poder modificar depois
        return view("editmaterias_a", compact("dados1", "id_mat_user", "fazer", "conc", "curso", "estagio", "ativs"));
    }
    public function editi(Request $request){
        $id_mat_user = $request->get("mat_user_id");
        $dados = MateriaUser::find($id_mat_user);
        //pegar o array de string e juntar em uma string so
        $fazer1 = $request->get('fazer');
        if(isset($fazer1)){
            $fazer2 = implode(",", $fazer1);
            $dados->fazer = $fazer2;
        }
        else{
            $dados->fazer = NULL;
        }
        $con1 = $request->get('concluido');
        if(isset($con1)){
            $con2 = implode(",", $con1);
            $dados->concluido = $con2;   
        }
        else{
            $dados->concluido = NULL;
        }
        //salvar no banco de dados
        $id_periodo = $dados->periodo_id;
        $dados->estagio = $request->get("estagio");
        $dados->ativs = $request->get("ativ");
        $dados->save();
        return redirect()->route('periodos', ['id' => $id_periodo]);
    }
}
?>