@extends('layouts.app')

@section('content')
<!-- CSS do Select2 para a barra de pesquisa -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white py-3">
                <h4 class="mb-0 text-secondary">Registar Nova Saída</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('emprestimos.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold">Documento Solicitado</label>
                        <!-- Adicionámos a classe 'select2-busca' aqui -->
                        <select name="documento_id" class="form-select select2-busca" required>
                            <option value=""></option>
                            @foreach($documentos as $documento)
                                <option value="{{ $documento->id }}">{{ $documento->id }} - {{ $documento->titulo_documento }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Utilizador Responsável</label>
                        <!-- Adicionámos a classe 'select2-busca' aqui -->
                        <select name="user_id" class="form-select select2-busca" required>
                            <option value=""></option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold">Data de Saída</label>
                        <input type="date" name="data_emprestimo" class="form-control" required>
                    </div>
                    
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('emprestimos.index') }}" class="btn btn-outline-secondary">Cancelar</a>
                        <button type="submit" class="btn btn-success px-4">Registar Empréstimo</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- jQuery e Select2 JS para o filtro -->
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