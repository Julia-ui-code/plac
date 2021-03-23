@extends('layouts.app6')

@section('content')
<div class="container">
    <center>
        <center>
        <img src="../uploads/avatars/{{ Auth::user()->avatar }}" alt="" style="width:130px; height:130px; border-radius:50%; margin-bottom:5px;">
        </center>
        <center>
        <span id="pontos"></span>
        <button type="submit" onclick="leiaMais()" id="btnLeiaMais" class="link" style="font-weight:medium;">Trocar Imagem</button>
        </center>
        <span id="mais">
            <form enctype="multipart/form-data" action="/perfiladm/updateft" method="POST" style="width:50%; margin-top:30px;">
                @csrf
                <input type="hidden" id="{{ Auth::user()->id }}" name="user_id" value="{{ Auth::user()->id }}">
                <label>Escolha sua imagem:</label>
                <input type="file" name="avatar">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <button type="submit" class="btn " style="color:white;font-weight:medium;background-color: #1C40C3;border-radius: 20px;position: absolute;margin-top:-7px;">Salvar</button>
            </form>
        </span>
    </center>
    <table class="table" style="margin-top:50px;">
        <tbody>
            <tr>
                <th>Nome:</th>
                <td style="text-align:right;">{{$usuario->name}}</td>
            </tr>
            <tr>
                <th>Email:</th>
                <td style="text-align:right;">{{$usuario->email}}</td>
            </tr>
        </tbody>
    </table>
    <form method="POST" action="{{ route('perfiladm/apagar', Auth::user()->id) }}" onsubmit="if(!confirm('Tem certeza que deseja apagar sua conta?')){ return false; }">
        @csrf
        @method ('DELETE')
        <button type="submit" class="btn btn-danger" style="font-weight:medium;border-radius: 20px;position: absolute;left:10%;">Apagar conta</button>
    </form>
    <a href="{{ route('perfiladm/show', Auth::user()->id) }}" class="btn" style="color:white;font-weight:medium;background-color: #1C40C3;border-radius: 20px;position: absolute;right:10%;">Editar</a>
</div>
<script>
    function leiaMais() {
        var pontos = document.getElementById("pontos");
        var maisTexto = document.getElementById("mais");
        var btnLeiaMais = document.getElementById("btnLeiaMais");
        if (pontos.style.display === "none") {
            pontos.style.display = "inline";
            maisTexto.style.display = "none";
            btnLeiaMais.innerHTML = "Trocar Imagem";
        } else {
            pontos.style.display = "none";
            maisTexto.style.display = "inline";
            btnLeiaMais.innerHTML = "Ocultar";
        }
    }
</script>
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