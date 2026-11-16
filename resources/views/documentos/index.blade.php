@extends('layouts.app')

@section('content')
<div class="card shadow-sm border-0">
    <div class="card-header bg-white pt-4 pb-3">
        <!-- Título e Botão Novo -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="mb-0 text-secondary fw-bold">Consulta de Documentos</h4>
            <a href="{{ route('documentos.create') }}" class="btn btn-primary">+ Arquivar Documento</a>
        </div>

        <!-- Barra de Pesquisa e Filtros Combinados -->
        <form action="{{ route('documentos.index') }}" method="GET" class="bg-light p-3 rounded border">
            <div class="row g-2 mb-2">
                <div class="col-md-12">
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0"><i class="bi bi-search text-muted"></i></span>
                        <input type="text"
                               name="search"
                               class="form-control border-start-0 ps-0"
                               placeholder="Buscar por ID, Título do Documento, Matrícula ou Nome do Aluno..."
                               value="{{ request('search') }}">
                    </div>
                </div>
            </div>

            <div class="row g-2 align-items-center">
                <div class="col-md-3">
                    <select name="curso_id" class="form-select">
                        <option value="">Todos os Cursos</option>
                        @foreach($cursos as $curso)
                            <option value="{{ $curso->id }}" {{ request('curso_id') == $curso->id ? 'selected' : '' }}>
                                {{ $curso->nome_curso }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3">
                    <select name="assunto_id" class="form-select">
                        <option value="">Todos os Assuntos</option>
                        @foreach($assuntos as $assunto)
                            <option value="{{ $assunto->id }}" {{ request('assunto_id') == $assunto->id ? 'selected' : '' }}>
                                {{ $assunto->nome_assunto }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3">
                    <select name="armario_id" class="form-select">
                        <option value="">Todos os Armários</option>
                        @foreach($armarios as $armario)
                            <option value="{{ $armario->id }}" {{ request('armario_id') == $armario->id ? 'selected' : '' }}>
                                {{ $armario->identificacao }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3 d-flex gap-2">
                    <button type="submit" class="btn btn-secondary w-100">
                        <i class="bi bi-funnel me-1"></i> Filtrar
                    </button>
                    <a href="{{ route('documentos.index') }}" class="btn btn-outline-secondary" title="Limpar filtros">
                        Limpar
                    </a>
                </div>
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
                        <th>PDF</th>
                        <th class="text-end pe-4">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($documentos as $doc)
                    <tr>
                        <td class="ps-4 text-muted">{{ $doc->id }}</td>
                        <td class="fw-bold">
                            <a href="{{ route('documentos.show', $doc->id) }}" class="text-primary text-decoration-none">
                                <i class="bi bi-file-earmark-text me-1 text-muted"></i>{{ $doc->titulo_documento }}
                            </a>
                        </td>
                        <td>
                            {{ $doc->aluno->nome_aluno ?? 'N/A' }}<br>
                            <small class="text-muted">{{ $doc->aluno->matricula_aluno ?? '' }}</small>
                        </td>
                        <td>{{ $doc->curso->nome_curso ?? 'N/A' }}</td>
                        <td>{{ $doc->assunto->nome_assunto ?? 'N/A' }}</td>
                        <td>
                            <span class="badge bg-secondary">{{ $doc->gaveta->armario->identificacao ?? 'N/A' }}</span>
                            <span class="badge bg-info text-dark">{{ $doc->gaveta->identificacao ?? 'N/A' }}</span>
                        </td>
                        <td>
                            @if($doc->arquivo_pdf)
                                <a href="{{ asset('storage/' . $doc->arquivo_pdf) }}" target="_blank" class="btn btn-sm btn-outline-danger" title="Abrir PDF">
                                    <i class="bi bi-file-earmark-pdf"></i>
                                </a>
                            @else
                                <span class="text-muted small">—</span>
                            @endif
                        </td>
                        <td class="text-end pe-4">
                            <div class="d-inline-flex gap-1">
                                <a href="{{ route('documentos.show', $doc->id) }}" class="btn btn-sm btn-outline-primary" title="Detalhes">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('documentos.edit', $doc->id) }}" class="btn btn-sm btn-outline-secondary" title="Editar">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('documentos.destroy', $doc->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Excluir" onclick="return confirm('Tem certeza que deseja excluir este documento?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center py-5 text-muted">
                            <i class="bi bi-inbox fs-2 d-block mb-2"></i>
                            Nenhum documento encontrado com estes filtros.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="card-footer bg-white border-0 py-3">
        {{ $documentos->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection