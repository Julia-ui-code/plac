@extends('layouts.app')

@section('content')
<div class="container">
    <center>
        <h4>Editar Perfil</h4>
    </center>
    <center>
    <form method="POST" action="{{ route('perfil/edit') }}" style="width:50%; margin-top:30px;">
        @csrf
        <input type="hidden" id="{{ Auth::user()->id }}" name="user_id" value="{{ Auth::user()->id }}">
        <div class="form-group row">
            <label for="nome" class="col-sm-2 col-form-label">Nome:</label>
            <div class="col-sm-10">
            <input type="text" class="form-control" id="nome" name="nome" value="{{$nome}}"></input>
            </div>
        </div>
        <div class="form-group row">
            <label for="email" class="col-sm-2 col-form-label">Email:</label>
            <div class="col-sm-10">
            <input type="text" class="form-control" id="email" name="email" value="{{$email}}">
            </div>
        </div>
        <button type="submit" class="btn offset-2" onsubmit="if(!confirm('Tem certeza que deseja editar seus dados?')){ return false; }" style="width:85%;color:white; background-color: #1C40C3;font-weight:medium;border-radius: 20px; margin-top:10px;">Salvar</button>
    </form>
    </center>
</div>
@endsection
