@extends('layouts.app')

@section('content')
<div class="mb-4">
    <h3 class="fw-bold text-secondary mb-0">Dashboard</h3>
    <p class="text-muted">Visão geral do setor de Estágios e Convênios</p>
</div>

<!-- Cartões de Resumo -->
<div class="row mb-4">
    <!-- Total de Documentos -->
    <div class="col-md-4 mb-3">
        <div class="card border-0 shadow-sm" style="border-left: 5px solid #0d6efd;">
            <div class="card-body">
                <h6 class="text-muted fw-bold mb-1">DOCUMENTOS ATIVOS</h6>
                <h2 class="mb-0 text-dark fw-bold">{{ $totalDocumentos }}</h2>
            </div>
        </div>
    </div>

    <!-- Documentos Emprestados -->
    <div class="col-md-4 mb-3">
        <div class="card border-0 shadow-sm" style="border-left: 5px solid #198754;">
            <div class="card-body">
                <h6 class="text-muted fw-bold mb-1">DOCUMENTOS EMPRESTADOS</h6>
                <h2 class="mb-0 text-dark fw-bold">{{ $documentosEmprestados }}</h2>
            </div>
        </div>
    </div>

    <!-- Total de Gavetas -->
    <div class="col-md-4 mb-3">
        <div class="card border-0 shadow-sm" style="border-left: 5px solid #ffc107;">
            <div class="card-body">
                <h6 class="text-muted fw-bold mb-1">GAVETAS CADASTRADAS</h6>
                <h2 class="mb-0 text-dark fw-bold">{{ $totalGavetas }}</h2>
            </div>
        </div>
    </div>
</div>

<!-- Tabela de Documentos Recentes -->
<div class="card border-0 shadow-sm">
    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
        <h5 class="mb-0 fw-bold text-secondary">Documentos Recentes</h5>
        <a href="{{ route('documentos.index') }}" class="btn btn-sm btn-outline-primary">Ver todos</a>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4">Título</th>
                        <th>Aluno</th>
                        <th>Curso</th>
                        <th>Assunto</th>
                        <th>Localização</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($documentosRecentes as $doc)
                    <tr>
                        <td class="ps-4 fw-bold text-primary">{{ $doc->titulo_documento }}</td>
                        <td>{{ $doc->aluno->nome_aluno ?? 'N/A' }}</td>
                        <td>{{ $doc->curso->nome_curso ?? 'N/A' }}</td>
                        <td>{{ $doc->assunto->nome_assunto ?? 'N/A' }}</td>
                        <td>
                            <span class="badge bg-secondary">Armário {{ $doc->gaveta->armario->identificacao ?? 'N/A' }}</span>
                            <span class="badge bg-info text-dark">Gaveta {{ $doc->gaveta->identificacao ?? 'N/A' }}</span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-4 text-muted">Nenhum documento arquivado ainda.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection