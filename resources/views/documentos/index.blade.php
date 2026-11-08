@extends('layouts.app')

@section('content')
<div class="card shadow-sm border-0">
    <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
        <h4 class="mb-0 text-secondary">Arquivo de Documentos</h4>
        <a href="{{ route('documentos.create') }}" class="btn btn-primary">+ Arquivar Documento</a>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-3">ID</th>
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
                        <td class="ps-3">{{ $doc->id }}</td>
                        <td class="fw-bold text-primary">{{ $doc->titulo_documento }}</td>
                        <td>{{ $doc->aluno->nome_aluno ?? 'N/A' }}</td>
                        <td>{{ $doc->curso->nome_curso ?? 'N/A' }}</td>
                        <td>{{ $doc->assunto->nome_assunto ?? 'N/A' }}</td>
                        <td>
                            <span class="badge bg-secondary">Armário {{ $doc->gaveta->armario->identificacao ?? 'N/A' }}</span>
                            <span class="badge bg-info text-dark">Gaveta {{ $doc->gaveta->identificacao ?? 'N/A' }}</span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection