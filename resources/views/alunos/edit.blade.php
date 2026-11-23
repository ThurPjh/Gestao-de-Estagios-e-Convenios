@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0 fw-bold text-dark">Editar Aluno</h5>
                <a href="{{ route('alunos.index') }}" class="btn btn-sm btn-outline-secondary">Voltar</a>
            </div>
            <div class="card-body">
                <form action="{{ route('alunos.update', $aluno->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Matrícula</label>
                        <input type="text"
                               name="matricula_aluno"
                               class="form-control @error('matricula_aluno') is-invalid @enderror"
                               value="{{ old('matricula_aluno', $aluno->matricula_aluno) }}"
                               required>
                        @error('matricula_aluno')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold">Nome Completo</label>
                        <input type="text"
                               name="nome_aluno"
                               class="form-control @error('nome_aluno') is-invalid @enderror"
                               value="{{ old('nome_aluno', $aluno->nome_aluno) }}"
                               required>
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('alunos.index') }}" class="btn btn-outline-secondary">Cancelar</a>
                        <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection