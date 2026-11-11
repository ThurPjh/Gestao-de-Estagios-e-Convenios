@extends('layouts.app')

@section('content')
<div class="card shadow-sm border-0">
    <div class="card-header bg-white pt-4 pb-3">
        <!-- Título e Botão Novo -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="mb-0 text-secondary fw-bold">Consulta de Documentos</h4>
            <a href="{{ route('documentos.create') }}" class="btn btn-primary">+ Arquivar Documento</a>
        </div>

        <!-- Barra de Pesquisa -->
        <form action="{{ route('documentos.index') }}" method="GET" class="row g-2 align-items-center bg-light p-3 rounded">
            <div class="col-md-8">
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0"><i class="bi bi-search text-muted"></i></span>
                    <input type="text" name="search" class="form-control border-start-0 ps-0" placeholder="Buscar por ID, Título, Matrícula, Aluno, Curso ou Assunto..." value="{{ request('search') }}">
                </div>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-secondary w-100">Pesquisar</button>
            </div>
            <div class="col-md-2">
                <a href="{{ route('documentos.index') }}" class="btn btn-outline-secondary w-100">Limpar</a>
            </div>
        </form>
    </div>
    
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4">ID</th>
                        <th>Título</th>
                        <th>Aluno</th>
                        <th>Curso</th>
                        <th>Assunto</th>
                        <th>Localização</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($documentos as $doc)
                    <tr>
                        <td class="ps-4 text-muted">{{ $doc->id }}</td>
                        <td class="fw-bold text-primary">
                            <i class="bi bi-file-earmark-text me-2 text-muted"></i>{{ $doc->titulo_documento }}
                        </td>
                        <td>
                            {{ $doc->aluno->nome_aluno ?? 'N/A' }}<br>
                            <small class="text-muted">{{ $doc->aluno->matricula_aluno ?? '' }}</small>
                        </td>
                        <td>{{ $doc->curso->nome_curso ?? 'N/A' }}</td>
                        <td>{{ $doc->assunto->nome_assunto ?? 'N/A' }}</td>
                        <td>
                            <span class="badge bg-secondary">Armário {{ $doc->gaveta->armario->identificacao ?? 'N/A' }}</span>
                            <span class="badge bg-info text-dark">Gaveta {{ $doc->gaveta->identificacao ?? 'N/A' }}</span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5 text-muted">
                            <i class="bi bi-inbox fs-2 d-block mb-2"></i>
                            Nenhum documento encontrado com estes filtros.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection