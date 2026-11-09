@extends('layouts.app')

@section('title', 'Alunos')

@push('styles')
<style>
    .table-card {
        background: var(--surface);
        border: 1px solid var(--line);
        border-radius: 12px;
        overflow: hidden;
    }
    .table-sca { margin: 0; }
    .table-sca thead th {
        background: #f7f9fd; color: var(--muted);
        font-size: .82rem; font-weight: 600;
        padding: 12px 20px; border-bottom: 1px solid var(--line);
    }
    .table-sca tbody td {
        padding: 14px 20px; vertical-align: middle;
        border-bottom: 1px solid var(--line); font-size: .92rem;
    }
    .table-sca tbody tr:last-child td { border-bottom: 0; }
    .table-sca tbody tr:hover { background: #f9fbff; }

    .aluno-cell { display: flex; align-items: center; gap: 12px; font-weight: 500; }
    .avatar {
        width: 34px; height: 34px; border-radius: 50%;
        background: var(--blue-soft); color: var(--blue);
        display: grid; place-items: center;
        font-size: .78rem; font-weight: 700; flex-shrink: 0;
    }
    .matricula { font-variant-numeric: tabular-nums; color: var(--muted); }

    .empty-state {
        padding: 48px 24px; text-align: center; color: var(--muted);
    }
    .empty-state i { font-size: 2rem; color: var(--blue); }
</style>
@endpush

@section('content')
<div class="page-head">
    <div>
        <h1>Alunos</h1>
        <p>Consulte e gerencie os alunos cadastrados.</p>
    </div>
    <a href="{{ route('alunos.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg"></i> Novo aluno
    </a>
</div>

<div class="table-card">
    @if($alunos->isEmpty())
        <div class="empty-state">
            <i class="bi bi-people"></i>
            <p class="mt-2 mb-0">Nenhum aluno cadastrado ainda. Clique em "Novo aluno" para começar.</p>
        </div>
    @else
        <div class="table-responsive">
            <table class="table table-sca">
                <thead>
                    <tr>
                        <th style="width: 80px;">ID</th>
                        <th style="width: 220px;">Matrícula</th>
                        <th>Nome do aluno</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($alunos as $aluno)
                        @php
                            $partes = preg_split('/\s+/', trim($aluno->nome_aluno));
                            $iniciais = mb_strtoupper(mb_substr($partes[0], 0, 1) . (count($partes) > 1 ? mb_substr(end($partes), 0, 1) : ''));
                        @endphp
                        <tr>
                            <td class="matricula">{{ $aluno->id }}</td>
                            <td class="matricula">{{ $aluno->matricula_aluno }}</td>
                            <td>
                                <div class="aluno-cell">
                                    <span class="avatar">{{ $iniciais }}</span>
                                    {{ $aluno->nome_aluno }}
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
