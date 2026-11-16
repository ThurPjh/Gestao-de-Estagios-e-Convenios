@extends('layouts.app')

@section('title', 'Gavetas')

@push('styles')
<style>
    .gaveta-card {
        background: var(--surface); border: 1px solid var(--line); border-radius: 12px;
        padding: 20px; height: 100%;
    }
    .gaveta-head { display: flex; align-items: center; gap: 12px; margin-bottom: 18px; }
    .gaveta-icon {
        width: 42px; height: 42px; border-radius: 10px; background: var(--blue-soft); color: var(--blue);
        display: grid; place-items: center; font-size: 1.25rem; flex-shrink: 0;
    }
    .gaveta-head h2 { font-size: 1rem; font-weight: 700; margin: 0; word-break: break-word; }
    .gaveta-head small { color: var(--muted); font-size: .82rem; }

    .occ-row { display: flex; justify-content: space-between; align-items: baseline; gap: 8px; }
    .occ-row .label { color: var(--muted); font-size: .85rem; }
    .occ-row strong { font-size: .9rem; white-space: nowrap; }
    .occ-bar { height: 7px; background: #e9eef6; border-radius: 99px; overflow: hidden; margin-top: 8px; }
    .occ-bar > div { height: 100%; border-radius: 99px; }
    .occ-ok > div { background: var(--ok); }
    .occ-warn > div { background: var(--warn); }
    .occ-danger > div { background: var(--danger); }
    .occ-pct { color: var(--muted); font-size: .8rem; margin-top: 6px; }
    .occ-pct.danger { color: var(--danger); font-weight: 600; }
    .occ-pct.warn { color: #b97700; font-weight: 600; }

    .btn-secondary-sca {
        border: 1px solid #c9d6ea; color: var(--blue); background: #fff;
        border-radius: 8px; font-weight: 600; padding: 9px 16px;
    }
    .btn-secondary-sca:hover { background: var(--blue-soft); border-color: var(--blue); color: var(--blue); }

    .empty-state {
        background: var(--surface); border: 1px dashed #c9d6ea; border-radius: 12px;
        padding: 48px 24px; text-align: center; color: var(--muted);
    }
    .empty-state i { font-size: 2rem; color: var(--blue); }
</style>
@endpush

@section('content')
@php $gavetas->load('armario', 'documentos'); @endphp

<div class="page-head">
    <div>
        <h1>Gavetas</h1>
        <p>Visualize a ocupação de cada gaveta.</p>
    </div>
    <div class="d-flex gap-2 flex-wrap">
        <a href="{{ route('armarios.index') }}" class="btn btn-secondary-sca">
            <i class="bi bi-archive"></i> Ver armários
        </a>
        <a href="{{ route('gavetas.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg"></i> Nova gaveta
        </a>
    </div>
</div>

@if($gavetas->isEmpty())
    <div class="empty-state">
        <i class="bi bi-inboxes"></i>
        <p class="mt-2 mb-0">Nenhuma gaveta cadastrada ainda. Clique em "Nova gaveta" para começar.</p>
    </div>
@else
    <div class="row g-3">
        @foreach($gavetas as $gaveta)
            @php
                $capacidade = (int) $gaveta->capacidade_maxima;
                $qtd = $gaveta->documentos->count();
                $ocupacao = $capacidade > 0 ? min(100, (int) round($qtd / $capacidade * 100)) : 0;
                $nivel = $ocupacao >= 90 ? 'danger' : ($ocupacao >= 80 ? 'warn' : 'ok');
            @endphp

            <div class="col-12 col-md-6 col-xl-3">
                <article class="gaveta-card">
                    <div class="gaveta-head">
                        <div class="gaveta-icon"><i class="bi bi-inbox"></i></div>
                        <div>
                            <h2>{{ $gaveta->identificacao }}</h2>
                            <small>{{ $gaveta->armario->identificacao ?? 'Sem armário' }}</small>
                        </div>
                    </div>

                    <div class="occ-row">
                        <span class="label">Documentos</span>
                        <strong>{{ $qtd }} / {{ $capacidade }}</strong>
                    </div>
                    <div class="occ-bar occ-{{ $nivel }}" role="progressbar"
                         aria-label="Ocupação da gaveta {{ $gaveta->identificacao }}"
                         aria-valuenow="{{ $ocupacao }}" aria-valuemin="0" aria-valuemax="100">
                        <div style="width: {{ $ocupacao }}%"></div>
                    </div>
                    <div class="occ-pct {{ $nivel === 'ok' ? '' : $nivel }}">
                        {{ $ocupacao }}% ocupada{{ $ocupacao >= 100 ? ' · cheia' : '' }}
                    </div>
                </article>
            </div>
        @endforeach
    </div>
@endif
@endsection
