@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white py-3">
                <h4 class="mb-0 text-secondary">Cadastrar Novo Assunto</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('assuntos.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-4">
                        <label class="form-label fw-bold">Nome do Assunto</label>
                        <input type="text" name="nome_assunto" class="form-control" placeholder="Ex: Termo de Compromisso" required>
                    </div>
                    
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('assuntos.index') }}" class="btn btn-outline-secondary">Cancelar</a>
                        <button type="submit" class="btn btn-success px-4">Salvar Assunto</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection