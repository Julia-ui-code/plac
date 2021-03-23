<html>
<head>
    <title>Planejamento Acadêmico - {{$id_periodo}}° Período</title>
    <style>
    body{
        margin-left: 50px;
        margin-right: 50px;
        margin-top: 20px;
        margin-bottom: 20px;
        font-family: 'Open Sans', sans-serif;
    }
    table {
        border: 1px solid #eee;
        border-collapse: collapse;
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
        text-align:center;
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
    </style>
</head>
<body>
    <p><b>Nome:</b> {{Auth::user()->name}}</p>
    <h3 style="text-align:center;">Planejamento Acadêmico - {{$id_periodo}}° Período</h3>
    <table align="center">
    <thead>
      <tr>
        <th>Matéria</th>
        <th>Pré-Requisito</th>
        <th>Co-Requisito</th>
        <th>Índice</th>
        <th>Horas Fixas</th>
      </tr>
    </thead>
    <tbody>
      @foreach($mat as $item)
        <tr>
            <td>{{$item->nome_materia}}</td>
            @if($item->pre_req == '-')
                <td>{{$item->pre_req}}</td>
            @else
                <td>-</td>
            @endif
            @if($item->co_req == '-')
                <td>{{$item->co_req}}</td>
            @else
                <td>-</td>
            @endif
            <td>{{$item->indice}}</td>
            <td>{{$item->horas}}</td>
        </tr>
    @endforeach
    <tr>
        <th colspan="4" style="text-align: right;">Total de horas:</th>
        <td>{{$totalhoras}}</td>
    </tr>
    </tbody>
  </table>
  </body>
</html>