@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white py-3">
                <h4 class="mb-0 text-secondary">Cadastrar Novo Curso</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('cursos.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-4">
                        <label class="form-label fw-bold">Nome do Curso</label>
                        <input type="text" name="nome_curso" class="form-control" placeholder="Ex: Sistemas de Informação" required>
                    </div>
                    
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('cursos.index') }}" class="btn btn-outline-secondary">Cancelar</a>
                        <button type="submit" class="btn btn-success px-4">Salvar Curso</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection