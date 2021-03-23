@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card py-3 px-3">
                <div class="card-body">
                    <p>A sigla PLAC significa Planejamento Acadêmico, é justamente essa a função deste
                        site. Através desta plataforma você terá um maior controle do seu rendimento
                        acadêmico e poderá se organizar de uma melhor forma resultando assim em um
                        melhor aproveitamento do curso. Por meio desse, você poderá planejar 
                        cada um dos seus semestres, visualizar o que já completou até o presente momento, bem 
                        como o que ainda está pendente, ver a grade das matérias obrigatórias e, também, das optativas, 
                        além dos pré e co-requisitos de cada uma. Outro ponto importante a ser ressaltado, é o fato de que, 
                        caso precise de orientação, você poderá solicitar à coordenação pedagógica tal auxílio, por meio 
                        de um e-mail, no qual deve enviar em anexo o período até então planejado e as mudanças que pretende 
                        realizar ou, simplesmente, solicitar uma sugestão de melhora.
                        Logo abaixo está a barra de rendimento onde será mostrado seu progresso ao decorrer do curso.
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-9"></div>
        <div class="col-md-3 py-3">
            <span id="pontos"></span>
            <button type="submit" onclick="leiaMais()" style="background-color: #1C40C3;"id="btnLeiaMais" class="btn btn-primary">{{ __('Mostrar') }}</button>
        </div>
    </div>
    <?php 
        use Illuminate\Support\Facades\Auth;
        use App\Models\MateriaUser;
        use App\Models\Materia;
        use App\Models\Cursos;
        $user_id = Auth::user()->id;
        $dados = MateriaUser::where('user_id', $user_id)->get();
        if(count($dados) != 0){
            $da = true;
            $curso_id = Auth::user()->curso_id;
            $dados_hr = Cursos::find($curso_id);
            $horas = 0;
            $horas_totais = $dados_hr->horas_materias + $dados_hr->horas_estagio + $dados_hr->horas_ativ;
            $id_conc = array();
            $esta = '';
            $ativs = '';
            $hr_esta_ativ = 0;
            foreach($dados as $d){
                array_push($id_conc, explode(",", $d->concluido));
                $esta = $d->estagio;
                $ativ = $d->ativs;
            }
            $hrs_array = array();
            foreach($id_conc as $i){
                foreach($i as $ii){
                    $nome_materiaco = Materia::find(intval($ii)); 
                    if(gettype($nome_materiaco) == 'object'){
                        array_push($hrs_array, $nome_materiaco->horas);
                    } 
                    else{
                        array_push($hrs_array, 0);
                    }
                }       
            }
            if($esta == 'concluido'){
                $hr_esta_ativ += $dados_hr->horas_estagio;
            }
            if($ativs == 'concluido'){
                $hr_esta_ativ += $dados_hr->horas_estagio;
            }
            $hr_ma = array_sum($hrs_array);
            $horas = $hr_esta_ativ + $hr_ma;
            $porcentagem = ($horas * 100) / $horas_totais;
            $porcentagem = number_format($porcentagem, 0);
        }
        else{
            $da = false;
        }
    ?>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <span id="mais">
            @if($da)
                <div class="progress">
                    <div class="progress-bar" role="progressbar" style="width: {{$porcentagem}}%;" aria-valuenow="{{$porcentagem}}" aria-valuemin="0" aria-valuemax="100" width="1000" height="1000">{{$porcentagem}}%</div>
                </div>
            @else
                <div class="progress">
                    <div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" width="1000" height="1000">0%</div>
                </div>
            @endif
            </span>
        </div>
    </div>
    </div>
</div>
<script>
    function leiaMais() {
        var pontos = document.getElementById("pontos");
        var maisTexto = document.getElementById("mais");
        var btnLeiaMais = document.getElementById("btnLeiaMais");
        if (pontos.style.display === "none") {
            pontos.style.display = "inline";
            maisTexto.style.display = "none";
            btnLeiaMais.innerHTML = "Mostrar";
        } else {
            pontos.style.display = "none";
            maisTexto.style.display = "inline";
            btnLeiaMais.innerHTML = "Ocultar";
        }
    }
</script>
<style>
    #mais{
        display: none;
    }

    #btnLeiaMais{
        background: "#000080";
        width: auto;
        height: auto;

    }

    .card,
    .card-body {
        font-size: medium;
        text-align: justify;
        width: 1000;
        height: 1000;
        background: #C4C4C4;
        border-radius: 20px;
    }
</style>
@endsection