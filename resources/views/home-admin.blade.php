@extends('layouts.app3')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card py-3 px-3">
                <div class="card-body">
                    <p>A sigla PLAC significa Planejamento Acadêmico, é justamente essa a função deste
                        site. O objetivo principal deste site é facilitar para o aluno a sua própria organização de 
                        carga horária e cumprimento dos períodos de seu curso. Por meio desse, o aluno pode planejar 
                        cada um dos seus semestres, visualizar o que ele já completou até o presente momento, bem 
                        como o que ainda está pendente, ver a grade das matérias obrigatórias e, também, das optativas, 
                        além dos pré e co-requisitos de cada uma. Outro ponto importante a ser ressaltado, é o fato de que, 
                        caso precise de orientação, o aluno pode solicitar à coordenação pedagógica tal auxílio, por meio 
                        de um e-mail, no qual ele envie em anexo o período até então planejado e as mudanças que pretende 
                        realizar ou, simplesmente, solicitar uma sugestão de melhora. Nessa área, o professor encontra 
                        algumas funções como cadastro de cursos, eixos e matérias(todas compondo o gerenciamento). Além disso, 
                        o professor pode ver os alunos cadastrados no sistema e torná-los administradores.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
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