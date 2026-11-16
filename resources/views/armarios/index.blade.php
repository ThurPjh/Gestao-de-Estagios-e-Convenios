
@extends('layouts.app')

@section('title', 'Armários')

@push('styles')
<style>
    .armario-card {
        background: var(--surface);
        border: 1px solid var(--line);
        border-radius: 12px;
        padding: 20px;
        height: 100%;
        display: flex;
        flex-direction: column;
    }
    .armario-head { display: flex; align-items: center; gap: 12px; margin-bottom: 20px; }
    .armario-icon {
        width: 42px; height: 42px; border-radius: 10px;
        background: var(--blue-soft); color: var(--blue);
        display: grid; place-items: center; font-size: 1.25rem; flex-shrink: 0;
    }
    .armario-head h2 { font-size: 1rem; font-weight: 700; margin: 0; word-break: break-word; }
    .armario-head small { color: var(--muted); font-size: .82rem; }

    .stat-label { color: var(--muted); font-size: .82rem; }
    .stat-value { font-size: 1.75rem; font-weight: 700; line-height: 1.2; margin-bottom: 16px; }

    .occ-row { display: flex; justify-content: space-between; align-items: baseline; }
    .occ-row strong { font-size: .9rem; }
    .occ-bar { height: 7px; background: #e9eef6; border-radius: 99px; overflow: hidden; margin: 6px 0 20px; }
    .occ-bar > div { height: 100%; border-radius: 99px; }
    .occ-ok > div { background: var(--ok); }
    .occ-warn > div { background: var(--warn); }
    .occ-danger > div { background: var(--danger); }
    .occ-row .occ-danger-text { color: var(--danger); }
    .occ-row .occ-warn-text { color: #b97700; }

    .btn-outline-sca {
        margin-top: auto; border: 1px solid #c9d6ea; color: var(--blue);
        background: #fff; border-radius: 8px; font-weight: 600; font-size: .9rem; padding: 8px 12px;
    }
    .btn-outline-sca:hover { background: var(--blue-soft); border-color: var(--blue); color: var(--blue); }

    .empty-state {
        background: var(--surface); border: 1px dashed #c9d6ea; border-radius: 12px;
        padding: 48px 24px; text-align: center; color: var(--muted);
    }
    .empty-state i { font-size: 2rem; color: var(--blue); }
</style>
@endpush

@section('content')
@php $armarios->load('gavetas.documentos'); @endphp

<div class="page-head">
    <div>
        <h1>Armários</h1>
        <p>Visualize a organização física dos documentos.</p>
    </div>
    <a href="{{ route('armarios.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg"></i> Novo armário
    </a>
</div>

@if($armarios->isEmpty())
    <div class="empty-state">
        <i class="bi bi-archive"></i>
        <p class="mt-2 mb-0">Nenhum armário cadastrado ainda. Clique em "Novo armário" para começar.</p>
    </div>
@else
    <div class="row g-3">
        @foreach($armarios as $armario)
            @php
                $gavetas = $armario->gavetas;
                $totalGavetas = $gavetas->count();
                $capacidade = $gavetas->sum('capacidade_maxima');
                $documentos = $gavetas->sum(fn ($g) => $g->documentos->count());
                $ocupacao = $capacidade > 0 ? min(100, (int) round($documentos / $capacidade * 100)) : 0;
                $nivel = $ocupacao >= 90 ? 'danger' : ($ocupacao >= 80 ? 'warn' : 'ok');
            @endphp

            <div class="col-12 col-md-6 col-xl-3">
                <article class="armario-card">
                    <div class="armario-head">
                        <div class="armario-icon"><i class="bi bi-archive"></i></div>
                        <div>
                            <h2>{{ $armario->identificacao }}</h2>
                            <small>{{ $totalGavetas }} {{ $totalGavetas === 1 ? 'gaveta' : 'gavetas' }}</small>
                        </div>
                    </div>

                    <div class="stat-label">Documentos</div>
                    <div class="stat-value">{{ $documentos }}</div>

                    <div class="occ-row">
                        <span class="stat-label">Ocupação</span>
                        <strong class="{{ $nivel === 'danger' ? 'occ-danger-text' : ($nivel === 'warn' ? 'occ-warn-text' : '') }}">{{ $ocupacao }}%</strong>
                    </div>
                    <div class="occ-bar occ-{{ $nivel }}" role="progressbar"
                         aria-label="Ocupação de {{ $armario->identificacao }}"
                         aria-valuenow="{{ $ocupacao }}" aria-valuemin="0" aria-valuemax="100">
                        <div style="width: {{ $ocupacao }}%"></div>
                    </div>

                    <a href="{{ route('gavetas.index') }}" class="btn btn-outline-sca">Ver gavetas</a>
                </article>
            </div>
        @endforeach
    </div>
@endif
@endsection

