@extends('layouts.app2')
<?php

use App\Models\Cursos;

$dados = Cursos::all();
?>
@section('content')
<style>
    body {
        padding: 0px;
    }
</style>
<div class="container py-5">
    <div class="py-5">
        <center>
            <img src="./img/plac_logo.png" alt="Logo PLAC" width="430" height="190">
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="form-group row">
                    <label for="name" class="col-md-3 col-form-label login text-md-right">{{ __('Nome:') }}</label>

                    <div class="col-md-7">
                        <input id="name" type="text" style="font-size:15px; width:80%;" class="form-control caixas  @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" placeholder="Aluno" autofocus>

                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="email" class="col-md-3 col-form-label login text-md-right">{{ __('Email:') }}</label>

                    <div class="col-md-7">
                        <input id="email" type="email" style="font-size:15px; width:80%;" class="form-control caixas @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="aluno@gmail.com">

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="curso_id" class="col-md-3 col-form-label login text-md-right">{{ __('Curso:') }}</label>

                    <div class="col-md-7 select">
                        <select name="curso_id" class="caixas" style="padding: 10px; width:80%; font-size:15px">
                            <option value=""></option>
                            @foreach($dados as $item)
                            <option value="{{$item->id}}" style="font-size:15px; width:80%;">{{$item->curso}}</option>
                            @endforeach
                        </select>

                        @error('curso_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password" class="col-md-3 col-form-label login text-md-right">{{ __('Senha:') }}</label>

                    <div class="col-md-7">
                        <input id="password" type="password" style="font-size:15px; width:80%;" class="form-control caixas @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="******">

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row mb-0">
                    <div class="col-12 ml-sm-5">
                        <button type="submit" style="width:46%;" class="ml-sm-5 pl-sm-5 btn btn-primary botao">
                            {{ __('Salvar') }}
                        </button>

                    </div>
                </div>
            </form>
            <div class="col-md-9 py-5 offset-sm-2">
                <p>
                    <font size="3">Já possui uma conta?</font><a class="btn btn-link esq" style="margin-bottom:5px;" href="{{ route('login') }}">
                        <font size="3">Faça o seu login</font>
                    </a>
                </p>
            </div>
        </center>
    </div>
</div>
@endsection