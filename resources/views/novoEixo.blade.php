@extends('layouts.app4')
@section('content')
<div class="row py-3">
    <div class="col-1"></div>
    <div class="col-lg-10 col-xs-12">
        <div class="card border">
            <div class="card-body">
                <form action="{{ route('eixos.store') }}" method="POST">
                    @csrf
                    @method('POST')

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
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session()->get('success') }}
                    </div>
                    @endif
                    <div class="form-group">
                        <label for="nome_eixo">Nome do Eixo:</label>
                        <input type="text" class="form-control" name="nome_eixo" id="nome_eixo" placeholder="Informe o nome do eixo" autofocus required>
                    </div>
                    <div class="form-group">
                        <label for="cursoEixo">Curso:</label><br/>
                        <select name="curso_id" style="padding: 10px;" required>
                            <option value=""></option>
                            @foreach ($curso as $item)
                            <option value="{{$item->id}}">{{$item->curso}}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm" style="background-color: #1C40C3;">Salvar</button>
                    <a class="btn btn-danger btn-sm" href="{{ route('eixos') }}">Cancelar</a>
                </form>
            </div>
        </div>
    </div>
    <div class="col-1"></div>
</div>
@endsection