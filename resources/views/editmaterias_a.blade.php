@extends('layouts.app')

@section('content')
<style>
    table {
        border: 1px solid #eee;
        border-collapse: collapse;
        text-align: left;
        width: 100%;
        align-items: center;
        font-family: 'Open Sans', sans-serif;
    }

    table thead th {
        padding: 10px;
        font-size: 1em;
        color: #000;
        font-weight: 600;
    }

    table tbody tr td {
        display: table-cell;
        font-weight: 400;
        padding: 10px;
        text-align: left;
        position: relative;
    }

    table tbody tr {

        border: none;
        display: table-row;
    }

    table tbody tr:nth-child(odd) {

        background: #f2f2f2;
    }

    table thead {

        display: table-header-group;
        font-weight: 500;
    }

    table tbody tr td:before {
        display: none;
    }

    table tbody tr td button:hover,
    table tbody tr td button:focus {
        background: #a795fe;
        cursor: pointer;
    }

    @media all and (max-width: 800px) {
        table tbody tr td {
            display: block;
            text-align: right;
        }

        table tbody tr td:before {
            content: attr(data-title);
            position: absolute;
            left: 15px;
            display: block;
            font-weight: 600;
            font-size: 1em;
        }

        table {
            border: none;
        }

        table thead {
            display: none;
        }

        table tbody tr {
            margin-bottom: 10px;
            display: block;
            border: 1px solid #dad6eb;
        }
    }
</style>
<div class="container">
    <div class="justify-content-center row" style="margin-top:-30px;">
        <h3 style="text-align:center; margin-top:41px; margin-right:60px;">Matérias</h3>
        <a href="#" disable data-toggle="tooltip" title="Passe o mouse por cima das palavras em negrito para saber o que são. Clique em Fazer nas matérias que deseja fazer nesse período e em Concluído nas matérias que já foram cursadas anteriormente.">
        <img src="/img/interrogacao.svg" alt="Interrogação" width="25" height="25" style="text-align:center; margin-bottom:-85px; margin-left:-50px;">
        </a>
    </div>
    <form method="POST" action="{{ route('materias_a/editi') }}">
        @csrf
    <input type="hidden" id="{{ $id_mat_user }}" name="mat_user_id" value="{{ $id_mat_user }}">
    <table>
    <thead>
      <tr>
        <th data-toggle="tooltip" title="Nome da matéria.">Matéria</th>
        <th data-toggle="tooltip" title="Matéria que deve ser concluída antes desta em questão.">Pré-Requisito</th>
        <th data-toggle="tooltip" title="Matéria que deve ser cursada em conjunto desta em questão.">Co-Requisito</th>
        <th data-toggle="tooltip" title="Carga horária da matéria.">Horas Fixas</th>
        <th data-toggle="tooltip" title="Obrigatoriedade ou não da matéria para o curso.">Categoria</th>
        <th data-toggle="tooltip" title="Escolha!!!">Selecionar</th>
      </tr>
    </thead>
    <tbody>
      @foreach($dados1 as $item)
        <tr>
            <td data-title="Matéria">{{$item->nome_materia}}</td>
            @if($item->pre_req == '-')
                <td class="traco" data-title="Pré-requisito">{{$item->pre_req}}</td>
            @else
                <td class="traco" data-title="Pré-requisito">{{$item->pre_req}} <font color="red"><strong>*</strong></font></td>
            @endif
            @if($item->co_req == '-')
                <td class="traco" data-title="Co-requisito">{{$item->co_req}}</td>
            @else
                <td class="traco" data-title="Co-requisito">{{$item->co_req}} <font color="red"><strong>**</strong></font></td>
            @endif
            <td data-title="Horas Fixas">{{$item->horas}}</td>
            <td data-title="Categoria">{{$item->cat}}</td>
            <td data-title="Selecionar">
                @if(in_array($item->id, $fazer))
                <input type="checkbox" id="{{ $item->id }}" name="fazer[]" value="{{ $item->id }}" checked>
                <label for="fazer">Fazer</label>
                @else
                <input type="checkbox" id="{{ $item->id }}" name="fazer[]" value="{{ $item->id }}">
                <label for="fazer">Fazer</label>
                @endif
                @if(in_array($item->id, $conc))
                <input style="margin-left:5px;"type="checkbox" id="{{ $item->id }}" name="concluido[]" value="{{ $item->id }}" checked>
                <label for="concluido">Concluído</label>
                @else
                <input style="margin-left:5px;"type="checkbox" id="{{ $item->id }}" name="concluido[]" value="{{ $item->id }}">
                <label for="concluido">Concluído</label>
                @endif
            </td>
        </tr>
    @endforeach
    </tbody>
  </table>
  <table style="margin-top:20px;">
    <thead>
      <tr>
        <th data-toggle="tooltip" title="Outros.">Outros</th>
        <th data-toggle="tooltip" title="Carga horária.">Horas Fixas</th>
        <th data-toggle="tooltip" title="Escolha!!!">Selecionar</th>
      </tr>
    </thead>
    <tbody>
        <tr> 
            @if($estagio == 'concluido')
                <td data-title="Outros">Estágio</td>
                <td data-title="Horas Fixas">{{$curso->horas_estagio}}</td>
                <td data-title="Selecionar">
                    <input style="margin-left:5px;"type="checkbox" checked id="{{$curso->horas_estagio}}" name="estagio" value="{{$curso->horas_estagio}}">
                    <label for="concluido">Concluído</label>
                </td>
            @else
                <td data-title="Outros">Estágio</td>
                    <td data-title="Horas Fixas">{{$curso->horas_estagio}}</td>
                    <td data-title="Selecionar">
                    <input style="margin-left:5px;"type="checkbox" id="{{$curso->horas_estagio}}" name="estagio" value="{{$curso->horas_estagio}}">
                    <label for="concluido">Concluído</label>
                </td>
            @endif
        </tr>
        <tr>
            @if($ativs == 'concluido')
                <td data-title="Outros">Atividades curriculares</td>
                <td data-title="Horas Fixas">{{$curso->horas_ativ}}</td>
                <td data-title="Selecionar">
                    <input style="margin-left:5px;"type="checkbox" checked id="{{$curso->horas_ativ}}" name="ativ" value="{{$curso->horas_ativ}}">
                    <label for="concluido">Concluído</label>
                </td>
            @else
                <td data-title="Outros">Atividades curriculares</td>
                <td data-title="Horas Fixas">{{$curso->horas_ativ}}</td>
                <td data-title="Selecionar">
                    <input style="margin-left:5px;"type="checkbox"  id="{{$curso->horas_ativ}}" name="ativ" value="{{$curso->horas_ativ}}">
                    <label for="concluido">Concluído</label>
                </td>
            @endif
        </tr>
    </tbody>
  </table>
    <p><font color="red"><strong>*Você deve fazer essa(s) matéria(s) antes de fazer a matéria desejada</strong></font></p>
    <p style="margin-top:-15px;"><font color="red"><strong>**Você deve fazer essa(s) matéria(s) simultanemente com a matéria desejada</strong></font></p>
   <div class="row" style="margin-bottom:60px;">
    <button type="submit" class="btn" style="color:white; font-weight:medium; background-color: #1C40C3;border-radius: 20px; margin-top:10px; position: absolute;right:10%">Continuar</button>
    </div>
</form>
</div>
@endsection