@extends('layouts.app2')
@section('content')
<style>
body{
    background-color: #2078CD;
}
.container{
    background-color: white; 
    width: 80%;
    margin-top: 75px;
    padding: 0px;
}
ul li{
    width: 50%;
    border: none;
}

</style>
<div class="container">
    <center>
        <ul class="nav nav-tabs justify-content-center">
            <li class="active"><a data-toggle="tab" href="#aluno"><font size="3">Aluno</font></a></li>
            <li><p style="margin-top:10px;"><a href="{{ route('login-admin') }}"><font size="3">Administrador</font></a></p></li>
        </ul>
    </center>
    <div class="tab-content">
        <!-- login do aluno -->
        <div id="aluno" class="tab-pane active">
            <center>
                    <center>
                        <img src="./img/plac_logo.png" alt="Logo PLAC" width="470" height="190" style="margin-left:-50px;">
                    </center>
                    <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group row" style="width:75%">
                        <label for="email" class="col-sm-2 col-form-label text-sm-right"> <font size="3">{{ __('Email:') }}</font></label>
                        <div class="col-sm-10" >
                            <input style="font-size:15px; width:85%; height: 30px; margin-top:5px;border-radius: 20px;border:1px solid grey;"class="form-control @error('email') is-invalid @enderror" id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="aluno@gmail.com" autofocus></input>
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row" style="width:75%">
                        <label for="password" class="col-sm-2 col-form-label text-sm-right"> <font size="3">{{ __('Senha:') }}</font></label>
                        <div class="col-sm-10" >
                            <input style="font-size:15px; width:85%; height: 30px; margin-top:5px;border-radius: 20px;border:1px solid grey;" id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="******"></input>
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="ml-md-5 pl-md-5">
                        <hr class="offset-md-3 pl-md-5"style="height:1px;width:54%;border-width:0;color:gray;background-color:gray; margin-top:20px;">
                    </div>
                    <div class="form-group row">
                        <div class="col-12 pl-md-5 ml-md-4">
                            <button type="submit" class="btn btn-primary botao offset-md-1">
                                {{ __('Entrar') }}
                            </button>
                        </div>
                    </div>
                    <div class="col-md-8 offset-md-2">
                        @if (Route::has('password.request'))
                        <a class="btn btn-link esq offset-md-2" href="{{ route('password.request') }}">
                            <font size="3">{{ __('Esqueceu sua senha?') }}</font>
                        </a>
                        @endif
                    </div>
                    </form>
                    <div class="col-md-9 offset-md-2 py-5">
                        <p><font size="3">Não tem uma conta?</font><a class="btn btn-link esq" style="margin-bottom:6px;" href="{{ route('register') }}"><font size="3">Cadastre-se</font></a></p>
                    </div>

            </center>
        </div>

    </div>
</div>
@endsection