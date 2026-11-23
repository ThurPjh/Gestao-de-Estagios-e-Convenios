@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0 fw-bold text-dark">Editar Assunto</h5>
                <a href="{{ route('assuntos.index') }}" class="btn btn-sm btn-outline-secondary">Voltar</a>
            </div>
            <div class="card-body">
                <form action="{{ route('assuntos.update', $assunto->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="form-label fw-semibold">Nome do Assunto</label>
                        <input type="text"
                               name="nome_assunto"
                               class="form-control @error('nome_assunto') is-invalid @enderror"
                               value="{{ old('nome_assunto', $assunto->nome_assunto) }}"
                               required>
                        @error('nome_assunto')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('assuntos.index') }}" class="btn btn-outline-secondary">Cancelar</a>
                        <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection