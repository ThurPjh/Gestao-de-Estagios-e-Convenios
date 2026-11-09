@extends('layouts.app')

@section('title', 'Empréstimos')

@push('styles')
<style>
    .table-card { background: var(--surface); border: 1px solid var(--line); border-radius: 12px; overflow: hidden; }
    .table-sca { margin: 0; }
    .table-sca thead th {
        background: #f7f9fd; color: var(--muted); font-size: .82rem; font-weight: 600;
        padding: 12px 20px; border-bottom: 1px solid var(--line); white-space: nowrap;
    }
    .table-sca tbody td { padding: 14px 20px; vertical-align: middle; border-bottom: 1px solid var(--line); font-size: .92rem; }
    .table-sca tbody tr:last-child td { border-bottom: 0; }
    .table-sca tbody tr:hover { background: #f9fbff; }
    .id-cell { font-variant-numeric: tabular-nums; color: var(--muted); }
    .doc-cell { font-weight: 600; }
    .date-cell { font-variant-numeric: tabular-nums; white-space: nowrap; }

    .pill {
        display: inline-block; padding: 4px 12px; border-radius: 99px;
        font-size: .8rem; font-weight: 600; white-space: nowrap;
    }
    .pill-ok { background: #e3f6ea; color: #17803d; }
    .pill-warn { background: #fdf0d5; color: #a86400; }

    .empty-state { padding: 48px 24px; text-align: center; color: var(--muted); }
    .empty-state i { font-size: 2rem; color: var(--blue); }
</style>
@endpush

@section('content')
@php $emprestimos->load('documento', 'user'); @endphp

<div class="page-head">
    <div>
        <h1>Empréstimos</h1>
        <p>Acompanhe as saídas e devoluções dos documentos físicos.</p>
    </div>
    <a href="{{ route('emprestimos.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg"></i> Registrar saída
    </a>
</div>

<div class="table-card">
    @if($emprestimos->isEmpty())
        <div class="empty-state">
            <i class="bi bi-arrow-left-right"></i>
            <p class="mt-2 mb-0">Nenhuma saída registrada ainda. Clique em "Registrar saída" para começar.</p>
        </div>
    @else
        <div class="table-responsive">
            <table class="table table-sca">
                <thead>
                    <tr>
                        <th style="width: 70px;">ID</th>
                        <th>Documento</th>
                        <th>Responsável</th>
                        <th>Data de saída</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($emprestimos as $emprestimo)
                        <tr>
                            <td class="id-cell">{{ $emprestimo->id }}</td>
                            <td class="doc-cell">{{ $emprestimo->documento->titulo_documento ?? 'N/A' }}</td>
                            <td>{{ $emprestimo->user->name ?? 'N/A' }}</td>
                            <td class="date-cell">{{ \Carbon\Carbon::parse($emprestimo->data_emprestimo)->format('d/m/Y') }}</td>
                            <td>
                                @if($emprestimo->status == 'Devolvido')
                                    <span class="pill pill-ok">Devolvido</span>
                                @else
                                    <span class="pill pill-warn">Emprestado</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
