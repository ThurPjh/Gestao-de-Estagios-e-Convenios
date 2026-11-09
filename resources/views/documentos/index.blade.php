@extends('layouts.app')

@section('title', 'Documentos')

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
    .item-cell { display: flex; align-items: center; gap: 12px; font-weight: 600; }
    .item-icon {
        width: 34px; height: 34px; border-radius: 8px; background: var(--blue-soft); color: var(--blue);
        display: grid; place-items: center; font-size: 1rem; flex-shrink: 0;
    }
    .local { display: inline-flex; align-items: center; gap: 6px; color: var(--ink); white-space: nowrap; }
    .local i { color: var(--muted); }
    .local .sep { color: #b4c0d3; }
    .empty-state { padding: 48px 24px; text-align: center; color: var(--muted); }
    .empty-state i { font-size: 2rem; color: var(--blue); }
</style>
@endpush

@section('content')
@php $documentos->load('aluno', 'curso', 'assunto', 'gaveta.armario'); @endphp

<div class="page-head">
    <div>
        <h1>Documentos</h1>
        <p>Consulte e gerencie os documentos do setor de Estágios e Convênios.</p>
    </div>
    <a href="{{ route('documentos.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg"></i> Arquivar documento
    </a>
</div>

<div class="table-card">
    @if($documentos->isEmpty())
        <div class="empty-state">
            <i class="bi bi-file-earmark-text"></i>
            <p class="mt-2 mb-0">Nenhum documento arquivado ainda. Clique em "Arquivar documento" para começar.</p>
        </div>
    @else
        <div class="table-responsive">
            <table class="table table-sca">
                <thead>
                    <tr>
                        <th style="width: 70px;">ID</th>
                        <th>Título</th>
                        <th>Aluno</th>
                        <th>Curso</th>
                        <th>Assunto</th>
                        <th>Localização</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($documentos as $doc)
                        <tr>
                            <td class="id-cell">{{ $doc->id }}</td>
                            <td>
                                <div class="item-cell">
                                    <span class="item-icon"><i class="bi bi-file-earmark-text"></i></span>
                                    {{ $doc->titulo_documento }}
                                </div>
                            </td>
                            <td>{{ $doc->aluno->nome_aluno ?? 'N/A' }}</td>
                            <td>{{ $doc->curso->nome_curso ?? 'N/A' }}</td>
                            <td>{{ $doc->assunto->nome_assunto ?? 'N/A' }}</td>
                            <td>
                                <span class="local">
                                    <i class="bi bi-geo-alt"></i>
                                    {{ $doc->gaveta->armario->identificacao ?? 'N/A' }}
                                    <span class="sep">/</span>
                                    {{ $doc->gaveta->identificacao ?? 'N/A' }}
                                </span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
