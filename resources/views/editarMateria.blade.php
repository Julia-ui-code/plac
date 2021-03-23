@extends('layouts.app5')
@section('content')
<div class="row py-3">
    <div class="col-1"></div>
    <div class="col-lg-10 col-xs-12">
        <div class="card border">
            <div class="card-body">
                <form action="{{ route('materias.update', $dados->id) }}" method="POST">
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
                    <div class="form-group">
                        <label for="nome_materia">Nome da Matéria:</label>
                        <input type="text" class="form-control" name="nome_materia" id="nome_materia" value="{{$dados->nome_materia}}" required>
                    </div>
                    <div class="form-group">
                        <label for="cursoMateria">Curso:</label><br />
                        <select name="curso_id" style="padding: 10px;" required>
                            <option value="" disabled></option>
                            @foreach ($dados->Cursos as $item)
                            <option value="{{$item->id}}">{{$item->curso}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="eixoMateria">Eixo:</label><br />
                        <select name="eixo_id" style="padding: 10px;" required>
                            <option value="" disabled></option>
                            @foreach ($dados->Eixos as $item)
                            <option value="{{$item->id}}">{{$item->nome_eixo}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="idSelect2">Pré-requisito(s):</label><br />
                        <select class="select2 form-control" name="pre_req[]" id="idSelect2" multiple tabindex="-1" style="display: none; 
                        border-radius: 20px; margin-top: 3px; width: 100%; border: solid lightgrey 1px;">
                        @foreach($dados->Materia as $item)
                            <option value="{{$item->id}}" id="{{$item->id}}">{{$item->nome_materia}}</option>
                        @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="idSelect22">Co-requisito(s):</label><br />
                        <select class="select2 form-control" name="co_req[]" id="idSelect2" multiple="" tabindex="-1" style="display: none; 
                        border-radius: 20px; margin-top: 3px; width: 100%; border: solid lightgrey 1px;">
                        @foreach($dados->Materia as $item)
                        <option value="{{$item->id}}" id="{{$item->id}}">{{$item->nome_materia}}</option>
                        @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="horas">Carga horária:</label>
                        <input type="text" class="form-control" name="horas" id="horas" value="{{$dados->horas}}" required>
                    </div>
                    <div class="form-group">
                        @if($dados->cat == "Obrigatória")
                            <label for="cat">Categoria:</label><br/>
                            <input type="radio"  checked id="Obrigatória" name="cat" value="Obrigatória">
                            <label for="Obrigatória">Obrigatória</label><br>
                            <input type="radio" id="Optativa" name="cat" value="Optativa">
                            <label for="Optativa">Optativa</label><br>
                        @else
                            <label for="cat">Categoria:</label><br/>
                            <input type="radio" id="Obrigatória" name="cat" value="Obrigatória">
                            <label for="Obrigatória">Obrigatória</label><br>
                            <input type="radio" checked id="Optativa" name="cat" value="Optativa">
                            <label for="Optativa">Optativa</label><br>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="indice">Índice:</label>
                        <input type="text" class="form-control" name="indice" id="indice" value="{{$dados->indice}}" required>
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