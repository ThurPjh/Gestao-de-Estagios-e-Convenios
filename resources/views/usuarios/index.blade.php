@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center py-3">
        <div>
            <h5 class="mb-0 fw-bold text-dark">Operadores do Sistema</h5>
            <small class="text-muted">Controle de contas com acesso ao arquivo</small>
        </div>
        <a href="{{ route('usuarios.create') }}" class="btn btn-primary">
            <i class="bi bi-person-plus me-1"></i> Novo Operador
        </a>
    </div>

    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th class="ps-4">Nome</th>
                        <th>E-mail Institucional</th>
                        <th>Cadastrado em</th>
                        <th class="text-end pe-4">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($usuarios as $usuario)
                    <tr>
                        <td class="ps-4 fw-medium text-dark">
                            {{ $usuario->name }}
                            @if(auth()->id() === $usuario->id)
                                <span class="badge bg-light text-primary border ms-1">Você</span>
                            @endif
                        </td>
                        <td class="text-secondary">{{ $usuario->email }}</td>
                        <td class="text-muted small">{{ $usuario->created_at?->format('d/m/Y') ?? '-' }}</td>
                        <td class="text-end pe-4">
                            @if(auth()->id() !== $usuario->id)
                                <form action="{{ route('usuarios.destroy', $usuario->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Remover acesso deste operador?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection