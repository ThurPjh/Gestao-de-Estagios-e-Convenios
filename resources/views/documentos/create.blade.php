@extends('layouts.app')

@section('content')
<!-- CSS do Select2 para a barra de pesquisa -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

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
                            <!-- Adicionámos a classe 'select2-busca' aqui -->
                            <select name="aluno_id" class="form-select select2-busca" required>
                                <option value=""></option>
                                @foreach($alunos as $aluno)
                                    <option value="{{ $aluno->id }}">{{ $aluno->matricula_aluno }} - {{ $aluno->nome_aluno }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Curso</label>
                            <!-- Adicionámos a classe 'select2-busca' aqui -->
                            <select name="curso_id" class="form-select select2-busca" required>
                                <option value=""></option>
                                @foreach($cursos as $curso)
                                    <option value="{{ $curso->id }}">{{ $curso->nome_curso }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Assunto</label>
                            <!-- Adicionámos a classe 'select2-busca' aqui -->
                            <select name="assunto_id" class="form-select select2-busca" required>
                                <option value=""></option>
                                @foreach($assuntos as $assunto)
                                    <option value="{{ $assunto->id }}">{{ $assunto->nome_assunto }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Localização (Gaveta)</label>
                            <!-- Adicionámos a classe 'select2-busca' aqui -->
                            <select name="gaveta_id" class="form-select select2-busca" required>
                                <option value=""></option>
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

<!-- jQuery e Select2 JS para fazer a mágica acontecer -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        // Aplica o filtro de pesquisa a todos os selects com a classe 'select2-busca'
        $('.select2-busca').select2({
            placeholder: "-- Digite para pesquisar --",
            allowClear: true,
            width: '100%' // Garante que não quebra o layout do Bootstrap
        });
    });
</script>
@endsection