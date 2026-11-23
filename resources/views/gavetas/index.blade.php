@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold text-dark mb-0">Gavetas</h4>
        <small class="text-muted">Visualize a ocupação física de cada gaveta</small>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('armarios.index') }}" class="btn btn-outline-secondary bg-white">
            <i class="bi bi-archive me-1"></i> Ver Armários
        </a>
        <a href="{{ route('gavetas.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg me-1"></i> Nova Gaveta
        </a>
    </div>
</div>

<div class="row g-3">
    @forelse($gavetas as $gaveta)
        @php
            $qtdDocs = $gaveta->documentos_count ?? $gaveta->documentos()->count();
            $capacidade = $gaveta->capacidade ?? 0;
            $percentual = $capacidade > 0 ? min(100, round(($qtdDocs / $capacidade) * 100)) : 0;
            $corBarra = $percentual >= 90 ? 'bg-danger' : ($percentual >= 70 ? 'bg-warning' : 'bg-primary');
        @endphp

        <div class="col-md-6 col-lg-3">
            <div class="card h-100">
                <div class="card-body d-flex flex-column justify-content-between">
                    <div>
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="badge bg-light text-secondary border">
                                <i class="bi bi-archive me-1"></i>{{ $gaveta->armario->identificacao ?? 'Sem Armário' }}
                            </span>
                            <i class="bi bi-inboxes text-muted"></i>
                        </div>

                        <h5 class="fw-bold text-dark mb-3">{{ $gaveta->identificacao }}</h5>
                    </div>

                    <div>
                        <div class="d-flex justify-content-between small mb-1">
                            <span class="text-muted">Documentos</span>
                            <strong class="text-dark">
                                {{ $qtdDocs }}{{ $capacidade > 0 ? ' / ' . $capacidade : ' arquivados' }}
                            </strong>
                        </div>

                        @if($capacidade > 0)
                            <div class="progress mb-2" style="height: 6px;">
                                <div class="progress-bar {{ $corBarra }}" style="width: {{ $percentual }}%;"></div>
                            </div>
                            <div class="text-end" style="font-size: 0.75rem; color: #6b7280;">
                                {{ $percentual }}% ocupada
                            </div>
                        @else
                            <div class="progress mb-2" style="height: 6px;">
                                <div class="progress-bar bg-primary" style="width: {{ $qtdDocs > 0 ? '25%' : '0%' }};"></div>
                            </div>
                            <div class="text-end" style="font-size: 0.75rem; color: #6b7280;">
                                Capacidade livre
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12">
            <div class="card">
                <div class="card-body text-center py-5 text-muted">
                    Nenhuma gaveta cadastrada.
                </div>
            </div>
        </div>
    @endforelse
</div>
@endsection