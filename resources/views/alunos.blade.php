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
        <h3 style="text-align:center" class="p-3">Alunos</h3>
    </div>
    <table>
        <thead>
            <tr>
                <th data-toggle="tooltip">Código</th>
                <th data-toggle="tooltip">Nome</th>
                <th data-toggle="tooltip">Email</th>
                <th data-toggle="tooltip" style="text-align: center;">Ação</th>
            </tr>
        </thead>
        <tbody>
            @foreach($alunos as $item)
            <tr>
                <td data-title="Código:">{{ $item->id }}</td>
                <td data-title="Nome:">{{ $item->name }}</td>
                <td data-title="Email:">{{ $item->email }}</td>
                <td data-title="Ações:">
                    <div class="row justify-content-center">
                        <form method="POST" action="{{ route('alunos.destroy', $item->id)}}" onsubmit="if(!confirm('Tornar o aluno um novo administrador?')){ return false; }">
                            @csrf
                            @method ('DELETE')
                            <button style="margin-left:5px; background-color: #1C40C3;" type="submit" class="btn btn-primary">Tornar ADM</button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table> <br>
</div>
@endsection