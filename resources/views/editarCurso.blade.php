@extends('layouts.app5')
@section('content')
<div class="row py-3">
    <div class="col-1"></div>
    <div class="col-lg-10 col-xs-12">
        <div class="card border">
            <div class="card-body">
                <form action="{{ route('curso.update', $dados->id) }}" method="POST">
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
                        <label for="nomeCurso">Nome do Curso:</label>
                        <input type="text" class="form-control" name="nomeCurso" value="{{ $dados->curso }}" id="nomeCurso" required>
                    </div>
                    <div class="form-group">
                        <label for="qnt_periodos">Quantidade de Períodos:</label>
                        <input type="text" class="form-control" name="qnt_periodos" value="{{ $dados->qnt_periodos }}" id="qnt_periodos" required>
                    </div>
                    <div class="form-group">
                        <label for="horas_materias">Carga horária das matérias:</label>
                        <input type="text" class="form-control" name="horas_materias" id="horas_materias" value="{{ $dados->horas_materias }}" required>
                    </div>
                    <div class="form-group">
                        <label for="horas_estagio">Carga horária do estágio:</label>
                        <input type="text" class="form-control" name="horas_estagio" id="horas_estagio" value="{{ $dados->horas_estagio }}" required>
                    </div>
                    <div class="form-group">
                        <label for="horas_ativ">Carga horária das atividades curriculares:</label>
                        <input type="text" class="form-control" name="horas_ativ" id="horas_ativ" value="{{ $dados->horas_ativ }}" required>
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm" style="background-color: #1C40C3;">Salvar</button>
                    <a class="btn btn-danger btn-sm" href="{{ route('curso') }}">Cancelar</a>
                </form>
            </div>
        </div>
    </div>
    <div class="col-1"></div>
</div>

@endsection