@extends('layouts.app')

@section('content')
<style>
table {
    border: 1px solid #eee;
    border-collapse: collapse;
    text-align: center;
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
    text-align: center;
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
</style>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
    $(document).ready(function() {
        $("button[name='button']").click(function(){
            var hora_total = parseInt($("input[name='horatotal']").val());
            var valores = [];
            var valor = 0;
            $.each($("input[name='fazer[]']:checked"), function(){
                valores.push($(this).val());
            });
            for (var x=0; x < valores.length; x++) {
                valor += parseInt(valores[x]);
            }
            var percentual = (valor * 100) / hora_total;
            $("#texto1").html('<p>Porcentagem: ' + percentual.toFixed(2) + '%</p>');
            $("#texto2").html('<p>Total de horas: ' + valor + '</p>');
        });    
    });
</script>
<div class="container">
    <div class="justify-content-center row" style="margin-top:-30px;">
            <h3 style="text-align:center; margin-top:41px; margin-right:60px;">Simulador</h3>
            <a href="#" disable data-toggle="tooltip" title="Selecione determinadas matérias optativas e saiba a porcentagem da carga horária completa que você conseguirá cursando elas.">
            <img src="/img/interrogacao.svg" alt="Interrogação" width="25" height="25" style="text-align:center; margin-bottom:-85px; margin-left:-50px;">
            </a>
    </div>
    <form>
        <input type="hidden" id="{{$horas_totais}}" name="horatotal" value="{{$horas_totais}}">
        <table>
            <thead>
            <tr>
                <th data-toggle="tooltip" title="Nome da matéria.">Matérias</th>
                <th data-toggle="tooltip" title="Categoria.">Categoria</th>
                <th data-toggle="tooltip" title="Carga horária da matéria.">Horas Fixas</th>
            </tr>
            </thead>
            <tbody>
            @foreach($dados as $item)
                <tr>
                    <td data-title="Matéria">
                    <input type="checkbox" id="{{ $item->horas }}" name="fazer[]" value="{{ $item->horas }}" style="margin-right:15px;">
                    {{$item->nome_materia}}</td>
                    <td data-title="Categoria">{{$item->cat}}</td>
                    <td data-title="Horas Fixas">{{$item->horas}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="row justify-content-center">
            <button type="button" class="btn" name="button" style="color:white; font-weight:medium; background-color: #1C40C3;border-radius: 20px;margin-top:20px;">Calcular</button>
            <button type="reset" class="btn" name="limpar" style="margin-left:10px;color:white; font-weight:medium; background-color: #1C40C3;border-radius: 20px;margin-top:20px;">Limpar</button>
        </div>
    </form>
    <div id="texto1" class="row justify-content-center" style="margin-top:20px;">
    </div>
    <div id="texto2" class="row justify-content-center">
    </div>
</div>
@endsection
