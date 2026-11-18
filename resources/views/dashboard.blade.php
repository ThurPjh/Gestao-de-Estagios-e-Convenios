@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold text-dark mb-0">Painel Geral</h4>
        <small class="text-muted">Visão operacional do acervo físico e movimentação de empréstimos</small>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('documentos.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg me-1"></i> Arquivar Documento
        </a>
        <a href="{{ route('emprestimos.create') }}" class="btn btn-outline-secondary bg-white">
            <i class="bi bi-arrow-left-right me-1"></i> Novo Empréstimo
        </a>
    </div>
</div>

<!-- Cards de Indicadores -->
<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="card h-100" style="border-left: 4px solid #1a56db !important;">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <span class="text-uppercase fw-bold text-muted" style="font-size: 0.72rem; letter-spacing: 0.04em;">Total no Acervo</span>
                        <h2 class="fw-bold text-dark mt-1 mb-0">{{ $totalDocumentos }}</h2>
                    </div>
                    <span class="badge bg-light text-primary border">Documentos</span>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card h-100" style="border-left: 4px solid #059669 !important;">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <span class="text-uppercase fw-bold text-muted" style="font-size: 0.72rem; letter-spacing: 0.04em;">Disponíveis no Arquivo</span>
                        <h2 class="fw-bold text-dark mt-1 mb-0">{{ $disponiveis }}</h2>
                    </div>
                    <span class="badge bg-light text-success border">Em Gaveta</span>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card h-100" style="border-left: 4px solid #d97706 !important;">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <span class="text-uppercase fw-bold text-muted" style="font-size: 0.72rem; letter-spacing: 0.04em;">Empréstimos Ativos</span>
                        <h2 class="fw-bold text-dark mt-1 mb-0">{{ $emprestimosAtivos }}</h2>
                    </div>
                    <span class="badge bg-light text-warning border">Fora do Setor</span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Gráficos Operacionais -->
<div class="row g-3">
    <!-- Gráfico 1: Ocupação das Gavetas -->
    <div class="col-lg-6">
        <div class="card h-100">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span class="fw-bold text-dark">Ocupação Física · Top 6 Gavetas Mais Cheias</span>
                <small class="text-muted">Qtd. de documentos</small>
            </div>
            <div class="card-body">
                <div style="position: relative; height: 280px;">
                    <canvas id="chartGavetas"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Gráfico 2: Movimentação Mensal -->
    <div class="col-lg-6">
        <div class="card h-100">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span class="fw-bold text-dark">Movimentação · Empréstimos (Últimos 6 Meses)</span>
                <small class="text-muted">Retiradas registradas</small>
            </div>
            <div class="card-body">
                <div style="position: relative; height: 280px;">
                    <canvas id="chartEmprestimos"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        Chart.defaults.font.family = "'Inter', sans-serif";
        Chart.defaults.color = '#6b7280';

        // 1. Gráfico Horizontal: Gavetas Mais Cheias
        const ctxGavetas = document.getElementById('chartGavetas').getContext('2d');
        new Chart(ctxGavetas, {
            type: 'bar',
            data: {
                labels: @json($labelsGavetas),
                datasets: [{
                    label: 'Documentos arquivados',
                    data: @json($dadosGavetas),
                    backgroundColor: '#1a56db',
                    borderRadius: 4,
                    barThickness: 22
                }]
            },
            options: {
                indexAxis: 'y',
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    x: {
                        beginAtZero: true,
                        ticks: { precision: 0 },
                        grid: { color: '#f1f5f9' }
                    },
                    y: {
                        grid: { display: false }
                    }
                }
            }
        });

        // 2. Gráfico de Linha: Empréstimos por Mês
        const ctxEmprestimos = document.getElementById('chartEmprestimos').getContext('2d');
        new Chart(ctxEmprestimos, {
            type: 'line',
            data: {
                labels: @json($meses),
                datasets: [{
                    label: 'Empréstimos realizados',
                    data: @json($totaisEmprestimos),
                    borderColor: '#0d2140',
                    backgroundColor: 'rgba(13, 33, 64, 0.08)',
                    borderWidth: 2,
                    pointBackgroundColor: '#1a56db',
                    pointRadius: 4,
                    tension: 0.25,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: { precision: 0 },
                        grid: { color: '#f1f5f9' }
                    },
                    x: {
                        grid: { display: false }
                    }
                }
            }
        });
    });
</script>
@endsection