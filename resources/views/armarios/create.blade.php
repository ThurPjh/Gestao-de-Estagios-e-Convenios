@extends('layouts.app') <!-- Confirme se o seu amigo chamou o arquivo base de app, main ou index -->

@section('content')
<div class="container-fluid px-0">
    <!-- Cabeçalho idêntico ao da tela de Documentos -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="h4 mb-1 fw-bold text-dark">Cadastrar Novo Armário</h2>
            <p class="text-muted mb-0" style="font-size: 0.9rem;">Insira os dados para registar um novo armário no sistema.</p>
        </div>
    </div>

    <!-- Cartão Branco com Sombra -->
    <div class="card border-0 shadow-sm" style="border-radius: 8px;">
        <div class="card-body p-4">
            <form action="{{ route('armarios.store') }}" method="POST">
                @csrf
                
                <div class="mb-4 max-w-md" style="max-width: 500px;">
                    <label for="identificacao" class="form-label text-secondary fw-semibold mb-2">Identificação do Armário:</label>
                    <input type="text" name="identificacao" id="identificacao" class="form-control" placeholder="Ex: Armário A - Sala 2" required style="padding: 10px 15px; border-radius: 6px;">
                </div>

                <div class="d-flex gap-3 mt-5">
                    <button type="submit" class="btn btn-primary px-4 py-2" style="background-color: #0d6efd; border-radius: 6px; font-weight: 500;">
                        + Salvar Armário
                    </button>
                    <a href="{{ route('armarios.index') }}" class="btn btn-light px-4 py-2 text-secondary" style="border: 1px solid #e0e0e0; border-radius: 6px; font-weight: 500;">
                        Voltar
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection