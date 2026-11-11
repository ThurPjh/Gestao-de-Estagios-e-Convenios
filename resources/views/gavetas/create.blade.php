@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white py-3">
                <h4 class="mb-0 text-secondary">Cadastrar Nova Gaveta</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('gavetas.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold">Armário Pertencente</label>
                        <select name="armario_id" class="form-select" required>
                            <option value="">-- Selecione o Armário --</option>
                            @foreach($armarios as $armario)
                                <option value="{{ $armario->id }}">{{ $armario->identificacao }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold">Identificação da Gaveta</label>
                        <input type="text" name="identificacao" class="form-control" placeholder="Ex: Gaveta 01" required>
                    </div>
                    
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('gavetas.index') }}" class="btn btn-outline-secondary">Cancelar</a>
                        <button type="submit" class="btn btn-success px-4">Salvar Gaveta</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection