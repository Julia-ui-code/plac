@extends('layouts.app4')

@section('content')
<div class="container py-5">
    <center>
        <h4>Editar Perfil</h4>
    </center>
    <center>
        <form method="POST" action="{{ route('perfil2.update', Auth::user()->id) }}" style="width:50%; margin-top:30px;" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                    <li>{{$errors}}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            @if(session()->get('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>
            @endif
            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">Nome:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" name="name" value="{{$users->name}}"></input>
                </div>
            </div>
            <div class="form-group row">
                <label for="email" class="col-sm-2 col-form-label">Email:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="email" name="email" value="{{$users->email}}">
                </div>
            </div>
            <button type="submit" class="btn offset-2" onsubmit="if(!confirm('Tem certeza que deseja editar seus dados?')){ return false; }" style="width:85%;color:white; background-color: #1C40C3;font-weight:medium;border-radius: 20px; margin-top:10px;">Salvar</button>
        </form>
    </center>
</div>
@endsection