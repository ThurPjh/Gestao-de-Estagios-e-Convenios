@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white py-3">
                <h4 class="mb-0 text-secondary">Cadastrar Novo Aluno</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('alunos.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold">Matrícula</label>
                        <input type="text" name="matricula_aluno" class="form-control" placeholder="Ex: 20-1-31005" required>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold">Nome Completo</label>
                        <input type="text" name="nome_aluno" class="form-control" placeholder="Ex: João Silva" required>
                    </div>
                    
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('alunos.index') }}" class="btn btn-outline-secondary">Cancelar</a>
                        <button type="submit" class="btn btn-success px-4">Salvar Aluno</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection