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
table tbody tr td button:hover, table tbody tr td button:focus {
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
a.disabled {
    pointer-events: none;
}
</style>
<div class="container">
    <h5 style="margin-top:20px; margin-bottom:20px; text-align:center;">{{$id_periodo}}° Período</h5>
    <a href="/materias_a/editar/{{$id_mat_user}}" class="btn" style="color:white;font-weight:medium; background-color: red;border-radius: 20px;position: absolute;right:10%">Redefinir</a>
    <form method="POST" action="{{ route('concluido') }}">
        @csrf
        <input type="hidden" id="{{ Auth::user()->id }}" name="user_id" value="{{ Auth::user()->id }}">
        <input type="hidden" id="{{$id_periodo}}" name="periodo_id" value="{{$id_periodo}}">
    <table style="margin-top:65px;">
    <thead>
      <tr>
        <th>Matéria</th>
        <th>Pré-Requisito</th>
        <th>Co-Requisito</th>
        <th>Horas Fixas</th>
        <th data-toggle="tooltip" title="Clique quando concluir a máteria e clique em Salvar.">Concluído</th>
        <th>Indíce</th>
      </tr>
    </thead>
    <tbody>
      @if($vazio)
        <tr>
            <td data-title="Matéria">-</td>
            <td data-title="Pré-Requisito">-</td>
            <td data-title="Co-Requisito">-</td>
            <td data-title="Horas Fixas">-</td>
            <td data-title="Concluído">-</td>
            <td data-title="Indíce">-</td>
            <td>-</td>
        </tr>
        <h5 style="color: red;">Você já concluiu todas as matérias escolhidas para esse período!!!</h5>
    @else
        @foreach($fazerr as $d)
        <tr>
                <td data-title="Matéria">{{$d->nome_materia}}</td>
                @if($d->pre_req == '-')
                    <td class="traco" data-title="Pré-requisito">{{$d->pre_req}}</td>
                @else
                    <td class="traco" data-title="Pré-requisito">-</td>
                @endif
                @if($d->co_req == '-')
                    <td class="traco" data-title="Co-requisito">{{$d->co_req}}</td>
                @else
                    <td class="traco" data-title="Co-requisito">-</td>
                @endif
                <td data-title="Horas Fixas">{{$d->horas}}</td>
                <td data-title="Concluído">
                    <input type="checkbox" id="{{ $d->id }}" name="con[]" value="{{ $d->id }}">
                </td>
                <td data-title="Indíce">{{$d->indice}}</td>
        </tr>
        @endforeach
         @endif
    </tbody>
  </table>
  <div class="row" style="margin-bottom:60px;">
    @if($vazio)
    <a onclick="return false;" href="/periodos/pdf/{{$id_periodo}}" style="font-weight:large;position: absolute;left:10%; margin-top:10px;">Gerar PDF</a>
    @else
    <a href="/periodos/pdf/{{$id_periodo}}" style="font-weight:large;position: absolute;left:10%; margin-top:10px;">Gerar PDF</a>
    @endif
    <a href="mailto:?body=Retorne%20para%20esse%20email:%20{{Auth::user()->email}}" target="_blank"  style="font-weight:large;position: absolute;left:20%; margin-top:10px;">Enviar por email</a>
    <button type="submit" class="btn" style="color:white; font-weight:medium; background-color: #1C40C3;border-radius: 20px; margin-top:10px; position: absolute;right:10%;">Salvar</button>
    </div>
</form>
</div>
@endsection
