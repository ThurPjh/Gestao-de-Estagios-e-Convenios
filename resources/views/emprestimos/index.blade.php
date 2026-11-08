@extends('layouts.app')

@section('content')
<div class="card shadow-sm border-0">
    <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
        <h4 class="mb-0 text-secondary">Controlo de Empréstimos</h4>
        <a href="{{ route('emprestimos.create') }}" class="btn btn-primary">+ Registar Saída</a>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-3">ID</th>
                        <th>Documento</th>
                        <th>Responsável (User)</th>
                        <th>Data Saída</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($emprestimos as $emprestimo)
                    <tr>
                        <td class="ps-3">{{ $emprestimo->id }}</td>
                        <td class="fw-bold">{{ $emprestimo->documento->titulo_documento ?? 'N/A' }}</td>
                        <td>{{ $emprestimo->user->name ?? 'N/A' }}</td>
                        <td>{{ \Carbon\Carbon::parse($emprestimo->data_emprestimo)->format('d/m/Y') }}</td>
                        <td>
                            @if($emprestimo->status == 'Devolvido')
                                <span class="badge bg-success">Devolvido</span>
                            @else
                                <span class="badge bg-warning text-dark">Emprestado</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection