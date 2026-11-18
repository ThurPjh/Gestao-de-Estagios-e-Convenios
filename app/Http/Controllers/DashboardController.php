<?php

namespace App\Http\Controllers;

use App\Models\Documento;
use App\Models\Emprestimo;
use App\Models\Gaveta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 
use Carbon\Carbon;

class DashboardController extends Controller
{

public function index()
{
    // Cards de resumo rápido
    $totalDocumentos = Documento::count();
    $emprestimosAtivos = Emprestimo::where('status', 'Emprestado')->count();
    $disponiveis = $totalDocumentos - $emprestimosAtivos;

    // Gráfico 1: Top 6 Gavetas mais cheias (Alerta de capacidade física)
    $gavetasCheias = Gaveta::with('armario')
        ->withCount('documentos')
        ->orderByDesc('documentos_count')
        ->take(6)
        ->get();

    $labelsGavetas = $gavetasCheias->map(fn($g) => ($g->armario->identificacao ?? 'Arm.') . ' - ' . $g->identificacao);
    $dadosGavetas = $gavetasCheias->pluck('documentos_count');

    // Gráfico 2: Movimentação de Empréstimos nos últimos 6 meses
    $meses = collect();
    $totaisEmprestimos = collect();

    for ($i = 5; $i >= 0; $i--) {
        $data = Carbon::now()->subMonths($i);
        $meses->push($data->translatedFormat('M/Y'));
        
        $count = Emprestimo::whereYear('created_at', $data->year)
            ->whereMonth('created_at', $data->month)
            ->count();
            
        $totaisEmprestimos->push($count);
    }

    return view('dashboard', compact(
        'totalDocumentos',
        'emprestimosAtivos',
        'disponiveis',
        'labelsGavetas',
        'dadosGavetas',
        'meses',
        'totaisEmprestimos'
    ));
}
}