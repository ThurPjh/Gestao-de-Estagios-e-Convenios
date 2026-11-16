@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-1">
                <li class="breadcrumb-item"><a href="{{ route('documentos.index') }}" class="text-decoration-none">Documentos</a></li>
                <li class="breadcrumb-item active" aria-current="page">Detalhes #{{ $documento->id }}</li>
            </ol>
        </nav>
        <h3 class="fw-bold text-dark mb-0">{{ $documento->titulo_documento }}</h3>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('documentos.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left me-1"></i> Voltar
        </a>
        <a href="{{ route('documentos.edit', $documento->id) }}" class="btn btn-primary">
            <i class="bi bi-pencil-square me-1"></i> Editar
        </a>
    </div>
</div>

<div class="row g-4">
    <!-- Coluna Esquerda: Metadados e Localização -->
    <div class="col-lg-5">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-white py-3">
                <h6 class="mb-0 fw-bold text-secondary">Informações do Registro</h6>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <small class="text-muted d-block">Aluno</small>
                    <span class="fw-semibold text-dark fs-6">{{ $documento->aluno->nome_aluno ?? 'N/A' }}</span>
                    <span class="badge bg-light text-secondary border ms-1">{{ $documento->aluno->matricula_aluno ?? '' }}</span>
                </div>

                <div class="row mb-3">
                    <div class="col-6">
                        <small class="text-muted d-block">Curso</small>
                        <span class="fw-semibold text-dark">{{ $documento->curso->nome_curso ?? 'N/A' }}</span>
                    </div>
                    <div class="col-6">
                        <small class="text-muted d-block">Assunto</small>
                        <span class="fw-semibold text-dark">{{ $documento->assunto->nome_assunto ?? 'N/A' }}</span>
                    </div>
                </div>

                <hr class="my-3 text-muted">

                <div class="mb-3">
                    <small class="text-muted d-block mb-1">Localização Física</small>
                    <div class="d-flex align-items-center gap-2 p-2 bg-light rounded border">
                        <i class="bi bi-geo-alt-fill text-primary fs-5"></i>
                        <div>
                            <div class="fw-bold text-dark">{{ $documento->gaveta->armario->identificacao ?? 'Armário N/A' }}</div>
                            <small class="text-muted">{{ $documento->gaveta->identificacao ?? 'Gaveta N/A' }}</small>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <small class="text-muted d-block">Data de Arquivamento</small>
                    <span class="text-dark">{{ $documento->created_at->format('d/m/Y \à\s H:i') }}</span>
                </div>

                @if($documento->observacoes)
                <div class="mb-0">
                    <small class="text-muted d-block mb-1">Observações</small>
                    <div class="p-3 bg-light rounded text-secondary small">
                        {{ $documento->observacoes }}
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Coluna Direita: Leitor de PDF -->
    <div class="col-lg-7">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                <h6 class="mb-0 fw-bold text-secondary">
                    <i class="bi bi-file-earmark-pdf text-danger me-1"></i> Documento Digitalizado
                </h6>
                @if($documento->arquivo_pdf)
                <div class="d-flex gap-2">
                    <a href="{{ asset('storage/' . $documento->arquivo_pdf) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                        <i class="bi bi-box-arrow-up-right me-1"></i> Nova Aba
                    </a>
                    <a href="{{ asset('storage/' . $documento->arquivo_pdf) }}" download class="btn btn-sm btn-primary">
                        <i class="bi bi-download me-1"></i> Baixar PDF
                    </a>
                </div>
                @endif
            </div>
            <div class="card-body p-2 d-flex align-items-center justify-content-center bg-light" style="min-height: 500px;">
                @if($documento->arquivo_pdf)
                    <iframe src="{{ asset('storage/' . $documento->arquivo_pdf) }}" width="100%" height="550px" style="border: none; border-radius: 6px;"></iframe>
                @else
                    <div class="text-center text-muted py-5">
                        <i class="bi bi-file-earmark-x fs-1 d-block mb-2"></i>
                        <p class="mb-1 fw-semibold">Nenhum arquivo PDF anexado</p>
                        <small>Edite este documento caso deseje anexar a versão digitalizada.</small>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection