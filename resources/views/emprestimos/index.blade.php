@extends('layouts.app')

@section('content')
<div class="card shadow-sm border-0">
    <div class="card-header bg-white pt-4 pb-3">
        <!-- Título e Botão de Novo -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="mb-0 text-secondary fw-bold">Controlo de Empréstimos</h4>
            <a href="{{ route('emprestimos.create') }}" class="btn btn-primary">+ Registar Saída</a>
        </div>

        <!-- Barra de Pesquisa e Filtros -->
        <form action="{{ route('emprestimos.index') }}" method="GET" class="row g-2 align-items-center bg-light p-3 rounded">
            <div class="col-md-5">
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0"><i class="bi bi-search text-muted"></i></span>
                    <input type="text" name="search" class="form-control border-start-0 ps-0" placeholder="Buscar por ID, Título, Matrícula ou Aluno..." value="{{ request('search') }}">
                </div>
            </div>
            <div class="col-md-3">
                <select name="status" class="form-select">
                    <option value="">Todos os Status</option>
                    <option value="Emprestado" {{ request('status') == 'Emprestado' ? 'selected' : '' }}>Apenas Emprestados</option>
                    <option value="Devolvido" {{ request('status') == 'Devolvido' ? 'selected' : '' }}>Apenas Devolvidos</option>
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-secondary w-100">Filtrar</button>
            </div>
            <div class="col-md-2">
                <a href="{{ route('emprestimos.index') }}" class="btn btn-outline-secondary w-100">Limpar</a>
            </div>
        </form>
    </div>
    
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4">ID</th>
                        <th>Documento</th>
                        <th>Responsável</th>
                        <th>Data Saída</th>
                        <th>Status</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($emprestimos as $emprestimo)
                    <tr>
                        <td class="ps-4">{{ $emprestimo->id }}</td>
                        <td>
                            <span class="fw-bold text-primary">{{ $emprestimo->documento->titulo_documento ?? 'N/A' }}</span><br>
                            <small class="text-muted">Aluno: {{ $emprestimo->documento->aluno->nome_aluno ?? 'N/A' }} ({{ $emprestimo->documento->aluno->matricula_aluno ?? 'N/A' }})</small>
                        </td>
                        <td>{{ $emprestimo->user->name ?? 'N/A' }}</td>
                        <td>{{ \Carbon\Carbon::parse($emprestimo->data_emprestimo)->format('d/m/Y') }}</td>
                        <td>
                            @if($emprestimo->status == 'Devolvido')
                                <span class="badge bg-success">Devolvido</span>
                            @else
                                <span class="badge bg-warning text-dark">Emprestado</span>
                            @endif
                        </td>
                        <td>
                            @if($emprestimo->status == 'Emprestado')
                                <form action="{{ route('emprestimos.devolver', $emprestimo->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-sm btn-outline-success fw-bold" onclick="return confirm('Confirmar a devolução deste documento ao arquivo?')">
                                        <i class="bi bi-check2-circle"></i> Devolver
                                    </button>
                                </form>
                            @else
                                <span class="text-muted small">Devolvido em: {{ \Carbon\Carbon::parse($emprestimo->data_devolucao)->format('d/m/Y') }}</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-4 text-muted">Nenhum empréstimo encontrado com estes filtros.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection