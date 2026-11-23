@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header pt-3 pb-3">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="mb-0 fw-bold text-dark">Assuntos Cadastrados</h5>
            <a href="{{ route('assuntos.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-lg me-1"></i> Novo Assunto
            </a>
        </div>

        <form action="{{ route('assuntos.index') }}" method="GET" class="row g-2">
            <div class="col-md-9">
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0"><i class="bi bi-search text-muted"></i></span>
                    <input type="text"
                           name="search"
                           class="form-control border-start-0 ps-0"
                           placeholder="Verificar se o assunto já está registrado..."
                           value="{{ request('search') }}">
                </div>
            </div>
            <div class="col-md-3 d-flex gap-2">
                <button type="submit" class="btn btn-secondary w-100">Pesquisar</button>
                @if(request('search'))
                    <a href="{{ route('assuntos.index') }}" class="btn btn-outline-secondary">Limpar</a>
                @endif
            </div>
        </form>
    </div>

    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th class="ps-4">ID</th>
                        <th>Descrição do Assunto</th>
                        <th>Documentos Arquivados</th>
                        <th class="text-end pe-4">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($assuntos as $assunto)
                    <tr>
                        <td class="ps-4 text-muted">{{ $assunto->id }}</td>
                        <td class="fw-medium text-dark">{{ $assunto->nome_assunto }}</td>
                        <td>
                            <span class="badge bg-light text-dark border">{{ $assunto->documentos_count }}</span>
                        </td>
                        <td class="text-end pe-4">
                            <a href="{{ route('assuntos.edit', $assunto->id) }}" class="btn btn-sm btn-outline-secondary" title="Editar assunto">
                                <i class="bi bi-pencil me-1"></i> Editar
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center py-4 text-muted">Nenhum assunto encontrado.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="card-footer py-3">
        {{ $assuntos->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection