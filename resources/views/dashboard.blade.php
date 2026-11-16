@extends('layouts.app')

@section('content')
<div class="mb-4">
    <h3 class="fw-bold text-secondary mb-0">Dashboard</h3>
    <p class="text-muted">Visão geral do setor de Estágios e Convênios</p>
</div>

<!-- Cartões de Resumo -->
<div class="row mb-4">
    <div class="col-md-4 mb-3">
        <div class="card border-0 shadow-sm" style="border-left: 5px solid #0d6efd;">
            <div class="card-body">
                <h6 class="text-muted fw-bold mb-1">DOCUMENTOS ATIVOS</h6>
                <h2 class="mb-0 text-dark fw-bold">{{ $totalDocumentos }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <div class="card border-0 shadow-sm" style="border-left: 5px solid #198754;">
            <div class="card-body">
                <h6 class="text-muted fw-bold mb-1">DOCUMENTOS EMPRESTADOS</h6>
                <h2 class="mb-0 text-dark fw-bold">{{ $documentosEmprestados }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <div class="card border-0 shadow-sm" style="border-left: 5px solid #ffc107;">
            <div class="card-body">
                <h6 class="text-muted fw-bold mb-1">GAVETAS CADASTRADAS</h6>
                <h2 class="mb-0 text-dark fw-bold">{{ $totalGavetas }}</h2>
            </div>
        </div>
    </div>
</div>

<!-- NOVA SEÇÃO DE GRÁFICOS -->
<div class="row mb-4">
    <!-- Gráfico de Cursos (Donut) -->
    <div class="col-md-6 mb-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-white py-3">
                <h6 class="mb-0 fw-bold text-secondary">Documentos por Curso</h6>
            </div>
            <div class="card-body d-flex justify-content-center align-items-center">
                <div style="position: relative; height:250px; width:100%">
                    <canvas id="chartCursos"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Gráfico de Armários (Bar) -->
    <div class="col-md-6 mb-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-white py-3">
                <h6 class="mb-0 fw-bold text-secondary">Ocupação Física por Armário</h6>
            </div>
            <div class="card-body">
                <div style="position: relative; height:250px; width:100%">
                    <canvas id="chartArmarios"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Tabela de Documentos Recentes -->
<div class="card border-0 shadow-sm">
    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
        <h5 class="mb-0 fw-bold text-secondary">Documentos Recentes</h5>
        <a href="{{ route('documentos.index') }}" class="btn btn-sm btn-outline-primary">Ver todos</a>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4">Título</th>
                        <th>Aluno</th>
                        <th>Curso</th>
                        <th>Assunto</th>
                        <th>Localização</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($documentosRecentes as $doc)
                    <tr>
                        <td class="ps-4 fw-bold text-primary">{{ $doc->titulo_documento }}</td>
                        <td>{{ $doc->aluno->nome_aluno ?? 'N/A' }}</td>
                        <td>{{ $doc->curso->nome_curso ?? 'N/A' }}</td>
                        <td>{{ $doc->assunto->nome_assunto ?? 'N/A' }}</td>
                        <td>
                            <span class="badge bg-secondary">Armário {{ $doc->gaveta->armario->identificacao ?? 'N/A' }}</span>
                            <span class="badge bg-info text-dark">Gaveta {{ $doc->gaveta->identificacao ?? 'N/A' }}</span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-4 text-muted">Nenhum documento arquivado ainda.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- IMPORTAÇÃO DO CHART.JS -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- RENDERIZAÇÃO DOS GRÁFICOS -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Recebe os dados convertidos do Laravel
        const labelsCursos = {!! $labelsCursos !!};
        const dadosCursos = {!! $dadosCursos !!};
        
        const labelsArmarios = {!! $labelsArmarios !!};
        const dadosArmarios = {!! $dadosArmarios !!};

        // Paleta de cores corporativa baseada no Figma
        const colors = ['#1565e0', '#f0a020', '#198754', '#e5484d', '#0dcaf0', '#6f42c1'];

        // Gráfico 1: Rosca (Donut)
        new Chart(document.getElementById('chartCursos'), {
            type: 'doughnut',
            data: {
                labels: labelsCursos,
                datasets: [{
                    data: dadosCursos,
                    backgroundColor: colors,
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '70%',
                plugins: {
                    legend: { position: 'right' }
                }
            }
        });

        // Gráfico 2: Barras (Bar)
        new Chart(document.getElementById('chartArmarios'), {
            type: 'bar',
            data: {
                labels: labelsArmarios,
                datasets: [{
                    label: 'Documentos Arquivados',
                    data: dadosArmarios,
                    backgroundColor: '#1565e0',
                    borderRadius: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: { beginAtZero: true, ticks: { precision: 0 } }
                },
                plugins: {
                    legend: { display: false }
                }
            }
        });
    });
</script>
@endsection