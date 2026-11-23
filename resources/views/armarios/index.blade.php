@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold text-dark mb-0">Armários</h4>
        <small class="text-muted">Estrutura física de arquivamento do setor</small>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('gavetas.index') }}" class="btn btn-outline-secondary bg-white">
            <i class="bi bi-inboxes me-1"></i> Ver Gavetas
        </a>
        <a href="{{ route('armarios.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg me-1"></i> Novo Armário
        </a>
    </div>
</div>

<div class="row g-3">
    @forelse($armarios as $armario)
        @php
            $qtdGavetas = $armario->gavetas_count ?? $armario->gavetas()->count();
        @endphp

        <div class="col-md-6 col-lg-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <span class="text-uppercase fw-bold text-muted" style="font-size: 0.7rem; letter-spacing: 0.05em;">Unidade Física</span>
                            <h5 class="fw-bold text-dark mb-0 mt-1">{{ $armario->identificacao }}</h5>
                        </div>
                        <span class="badge bg-light text-primary border">
                            <i class="bi bi-archive"></i>
                        </span>
                    </div>

                    @if(!empty($armario->localizacao) || !empty($armario->descricao))
                        <p class="text-muted small mb-3">
                            {{ $armario->localizacao ?? $armario->descricao }}
                        </p>
                    @endif

                    <div class="pt-2 border-top d-flex justify-content-between align-items-center small">
                        <span class="text-muted">Gavetas vinculadas</span>
                        <span class="fw-bold text-dark">{{ $qtdGavetas }}</span>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12">
            <div class="card">
                <div class="card-body text-center py-5 text-muted">
                    Nenhum armário cadastrado.
                </div>
            </div>
        </div>
    @endforelse
</div>
@endsection