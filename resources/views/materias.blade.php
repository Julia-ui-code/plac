@extends('layouts.app3')

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
    @if(session()->get('danger'))
    <div class="alert alert-danger">
        {{ session()->get('danger') }}
    </div><br />
    @endif
    <div class="justify-content-center row">
        <h3 style="text-align:center" class="p-3">Matérias</h3>
    </div>
    <table>
        <thead>
            <tr>
                <th data-toggle="tooltip">Código</th>
                <th data-toggle="tooltip">Matéria</th>
                <th data-toggle="tooltip">Curso</th>
                <th data-toggle="tooltip">Eixo</th>
                <th data-toggle="tooltip">Pré-requisito(s)</th>
                <th data-toggle="tooltip">Co-requisito(s)</th>
                <th data-toggle="tooltip">Carga horária</th>
                <th data-toggle="tooltip">Categoria</th>
                <th data-toggle="tooltip">Índice</th>
                <th data-toggle="tooltip" style="text-align: center;">Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($dados as $item)
            <tr>
                <td data-title="Código:">{{ $item->id }}</td>
                <td data-title="Matéria:">{{ $item->nome_materia }}</td>
                <td data-title="Curso:">{{ $item->curso_id }}</td>
                <td data-title="Eixo:">{{ $item->eixo_id }}</td>
                @if($item->pre_req == '')
                    <td class="traco" data-title="Pré-requisito(s):">-</td>
                @else
                    <td class="traco" data-title="Pré-requisito(s):">{{ $item->pre_req }}</td>
                @endif
                @if($item->co_req == '')
                    <td class="traco" data-title="Co-requisito(s):">-</td>
                @else
                    <td class="traco" data-title="Co-requisito(s):">{{ $item->co_req }}</td>
                @endif
                <td data-title="Carga horária:">{{ $item->horas }}</td>
                <td data-title="Categoria:">{{ $item->cat }}</td>
                <td data-title="Índice:">{{ $item->indice }}</td>
                <td data-title="Ações:">
                    <div class="row justify-content-center">
                        <a href="{{ route('materias.edit', $item->id)}}" class="btn btn-primary">Editar</a>
                        <form method="POST" action="{{ route('materias.destroy', $item->id)}}" onsubmit="if(!confirm('Remover Matéria?')){ return false; }">
                            @csrf
                            @method ('DELETE')
                            <button style="margin-left:5px;" type="submit" class="btn btn-danger">Apagar</button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table> <br>
    <div class="row px-4">
        <a href="{{ route('materias.create') }}" style="background-color: #1C40C3;"class="btn btn-primary btn-sm" role="button">Adicionar nova matéria</a>
    </div>
    </form>
</div>
@endsection