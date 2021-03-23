@extends('layouts.app4')
@section('content')
<div class="row py-3">
    <div class="col-1"></div>
    <div class="col-lg-10 col-xs-12">
        <div class="card border">
            <div class="card-body">
                <form action="{{ route('materias.store') }}" method="POST">
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
                        <label for="nome_materia">Nome da Matéria:</label>
                        <input type="text" class="form-control" name="nome_materia" id="nome_materia" placeholder="Informe o nome da matéria" autofocus required>
                    </div>
                    <div class="form-group">
                        <label for="cursoMateria">Curso:</label><br />
                        <select name="curso_id" style="padding: 10px;" required>
                            <option value=""></option>
                            @foreach($curso as $item)
                            <option value="{{$item->id}}">{{$item->curso}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="eixoMateria">Eixo:</label><br />
                        <select name="eixo_id" style="padding: 10px;" required>
                            <option value=""></option>
                            @foreach($eixos as $item)
                            <option value="{{$item->id}}">{{$item->nome_eixo}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="idSelect2">Pré-requisito(s):</label><br />
                        <select class="select2 form-control" name="pre_req[]" id="idSelect2" multiple="" tabindex="-1" style="display: none; 
                        border-radius: 20px; margin-top: 3px; width: 100%; border: solid lightgrey 1px;">
                        @foreach($materias as $item)
                        <option value="{{$item->id}}" id="{{$item->id}}">{{$item->nome_materia}}</option>
                        @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="idSelect2">Co-requisito(s):</label><br />
                        <select class="select2 form-control" name="co_req[]" id="idSelect2" multiple="" tabindex="-1" style="display: none; 
                        border-radius: 20px; margin-top: 3px; width: 100%; border: solid lightgrey 1px;">
                        @foreach($materias as $item)
                        <option value="{{$item->id}}" id="{{$item->id}}">{{$item->nome_materia}}</option>
                        @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="horas">Carga horária:</label>
                        <input type="text" class="form-control" name="horas" id="horas" placeholder="Informe a carga horária da matéria" required>
                    </div>
                    <div class="form-group">
                        <label for="cat">Categoria:</label><br/>
                        <input type="radio" id="Obrigatória" name="cat" value="Obrigatória">
                        <label for="Obrigatória">Obrigatória</label><br>
                        <input type="radio" id="Optativa" name="cat" value="Optativa" required>
                        <label for="Optativa">Optativa</label><br>
                    </div>
                    <div class="form-group">
                        <label for="indice">Índice:</label>
                        <input type="text" class="form-control" name="indice" id="indice" placeholder="Informe o índice da matéria" required>
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm" style="background-color: #1C40C3;">Salvar</button>
                    <a class="btn btn-danger btn-sm" href="{{ route('materias') }}">Cancelar</a>
                </form>
            </div>
        </div>
    </div>
    <div class="col-1"></div>
</div>
<script>
    $(".select2").select2();
</script>
@endsection