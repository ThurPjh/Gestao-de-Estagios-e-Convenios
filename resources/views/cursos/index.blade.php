@extends('layouts.app')

@section('title', 'Cursos')

@push('styles')
<style>
    .table-card { background: var(--surface); border: 1px solid var(--line); border-radius: 12px; overflow: hidden; }
    .table-sca { margin: 0; }
    .table-sca thead th {
        background: #f7f9fd; color: var(--muted); font-size: .82rem; font-weight: 600;
        padding: 12px 20px; border-bottom: 1px solid var(--line);
    }
    .table-sca tbody td { padding: 14px 20px; vertical-align: middle; border-bottom: 1px solid var(--line); font-size: .92rem; }
    .table-sca tbody tr:last-child td { border-bottom: 0; }
    .table-sca tbody tr:hover { background: #f9fbff; }
    .id-cell { font-variant-numeric: tabular-nums; color: var(--muted); }
    .item-cell { display: flex; align-items: center; gap: 12px; font-weight: 500; }
    .item-icon {
        width: 34px; height: 34px; border-radius: 8px; background: var(--blue-soft); color: var(--blue);
        display: grid; place-items: center; font-size: 1rem; flex-shrink: 0;
    }
    .empty-state { padding: 48px 24px; text-align: center; color: var(--muted); }
    .empty-state i { font-size: 2rem; color: var(--blue); }
</style>
@endpush

@section('content')
<div class="page-head">
    <div>
        <h1>Cursos</h1>
        <p>Cursos disponíveis para vincular aos documentos.</p>
    </div>
    <a href="{{ route('cursos.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg"></i> Novo curso
    </a>
</div>

<div class="table-card">
    @if($cursos->isEmpty())
        <div class="empty-state">
            <i class="bi bi-mortarboard"></i>
            <p class="mt-2 mb-0">Nenhum curso cadastrado ainda. Clique em "Novo curso" para começar.</p>
        </div>
    @else
        <div class="table-responsive">
            <table class="table table-sca">
                <thead>
                    <tr>
                        <th style="width: 80px;">ID</th>
                        <th>Nome do curso</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cursos as $curso)
                        <tr>
                            <td class="id-cell">{{ $curso->id }}</td>
                            <td>
                                <div class="item-cell">
                                    <span class="item-icon"><i class="bi bi-mortarboard"></i></span>
                                    {{ $curso->nome_curso }}
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
