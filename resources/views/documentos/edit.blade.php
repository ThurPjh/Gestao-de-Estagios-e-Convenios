@extends('layouts.app')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                <h4 class="mb-0 text-secondary">Editar Documento #{{ $documento->id }}</h4>
                <a href="{{ route('documentos.show', $documento->id) }}" class="btn btn-sm btn-outline-secondary">Voltar aos Detalhes</a>
            </div>
            <div class="card-body">
                <form action="{{ route('documentos.update', $documento->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label fw-bold">Título do Documento</label>
                        <input type="text" name="titulo_documento" class="form-control" value="{{ old('titulo_documento', $documento->titulo_documento) }}" required>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Aluno</label>
                            <select name="aluno_id" class="form-select select2-busca" required>
                                @foreach($alunos as $aluno)
                                    <option value="{{ $aluno->id }}" {{ $documento->aluno_id == $aluno->id ? 'selected' : '' }}>
                                        {{ $aluno->matricula_aluno }} - {{ $aluno->nome_aluno }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Curso</label>
                            <select name="curso_id" class="form-select select2-busca" required>
                                @foreach($cursos as $curso)
                                    <option value="{{ $curso->id }}" {{ $documento->curso_id == $curso->id ? 'selected' : '' }}>
                                        {{ $curso->nome_curso }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Assunto</label>
                            <select name="assunto_id" class="form-select select2-busca" required>
                                @foreach($assuntos as $assunto)
                                    <option value="{{ $assunto->id }}" {{ $documento->assunto_id == $assunto->id ? 'selected' : '' }}>
                                        {{ $assunto->nome_assunto }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Localização (Gaveta)</label>
                            <select name="gaveta_id" class="form-select select2-busca" required>
                                @foreach($gavetas as $gaveta)
                                    <option value="{{ $gaveta->id }}" {{ $documento->gaveta_id == $gaveta->id ? 'selected' : '' }}>
                                        Armário: {{ $gaveta->armario->identificacao ?? 'N/A' }} | Gaveta: {{ $gaveta->identificacao }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Substituir ou Anexar PDF (Opcional)</label>
                        @if($documento->arquivo_pdf)
                            <div class="mb-2 small text-success">
                                <i class="bi bi-check-circle-fill"></i> Este registro já possui um PDF anexado. Envie outro apenas se quiser substituí-lo.
                            </div>
                        @endif
                        <input type="file" name="arquivo_pdf" class="form-control" accept="application/pdf">
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold">Observações</label>
                        <textarea name="observacoes" class="form-control" rows="3">{{ old('observacoes', $documento->observacoes) }}</textarea>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('documentos.index') }}" class="btn btn-outline-secondary">Cancelar</a>
                        <button type="submit" class="btn btn-primary px-4">Salvar Alterações</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.select2-busca').select2({
            placeholder: "-- Digite para pesquisar --",
            allowClear: true,
            width: '100%'
        });
    });
</script>
@endsection