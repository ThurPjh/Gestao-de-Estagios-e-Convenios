@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white py-3">
                <h4 class="mb-0 text-secondary">Arquivar Novo Documento</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('documentos.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold">Título do Documento</label>
                        <input type="text" name="titulo_documento" class="form-control" required>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Aluno</label>
                            <select name="aluno_id" class="form-select" required>
                                <option value="">-- Selecione --</option>
                                @foreach($alunos as $aluno)
                                    <option value="{{ $aluno->id }}">{{ $aluno->matricula_aluno }} - {{ $aluno->nome_aluno }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Curso</label>
                            <select name="curso_id" class="form-select" required>
                                <option value="">-- Selecione --</option>
                                @foreach($cursos as $curso)
                                    <option value="{{ $curso->id }}">{{ $curso->nome_curso }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Assunto</label>
                            <select name="assunto_id" class="form-select" required>
                                <option value="">-- Selecione --</option>
                                @foreach($assuntos as $assunto)
                                    <option value="{{ $assunto->id }}">{{ $assunto->nome_assunto }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Localização (Gaveta)</label>
                            <select name="gaveta_id" class="form-select" required>
                                <option value="">-- Selecione --</option>
                                @foreach($gavetas as $gaveta)
                                    <option value="{{ $gaveta->id }}">Armário: {{ $gaveta->armario->identificacao ?? 'N/A' }} | Gaveta: {{ $gaveta->identificacao }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold">Observações</label>
                        <textarea name="observacoes" class="form-control" rows="3"></textarea>
                    </div>
                    
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('documentos.index') }}" class="btn btn-outline-secondary">Cancelar</a>
                        <button type="submit" class="btn btn-success px-4">Salvar Documento</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection