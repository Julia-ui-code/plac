@extends('layouts.app6')

@section('content')
<div class="container">
    <div class="justify-content-center row">
        <h3 style="text-align:center" class="p-3">Perfil</h3>
    </div>
    <table class="table" style="margin-top:50px;">
        <tbody>
            <tr>
                <th>Nome:</th>
                <td style="text-align:right;">{{$users->name}}</td>
            </tr>
            <tr>
                <th>Email:</th>
                <td style="text-align:right;">{{$users->email}}</td>
            </tr>
        </tbody>
    </table>
    <form method="POST" action="{{ route('perfil2.destroy', Auth::user()->id) }}" onsubmit="if(!confirm('Tem certeza que deseja apagar sua conta?')){ return false; }">
        @csrf
        @method ('DELETE')
        <button type="submit" class="btn btn-danger" style="font-weight:medium;border-radius: 20px;position: absolute;left:10%;">Apagar conta</button>
    </form>
    <a href="{{ route('perfil2.show', Auth::user()->id) }}" class="btn" style="color:white;font-weight:medium;background-color: #1C40C3;border-radius: 20px;position: absolute;right:10%;">Editar</a>
</div>
<style>
    #mais {
        display: none;
    }

    #btnLeiaMais {
        background: "#000080";
        width: auto;
        height: auto;

    }

    .link {
        background: none !important;
        border: none;
        padding: 0 !important;
        /*optional*/
        font-family: arial, sans-serif;
        /*input has OS specific font-family*/
        color: #069;
        cursor: pointer;
    }

    .link:hover {
        text-decoration: underline;
    }
</style>
@endsection