<?php

namespace App\Http\Controllers;

use App\Models\Documento;
use App\Models\Emprestimo;
use App\Models\Gaveta;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Conta os totais para os cartões
        $totalDocumentos = Documento::count();
        
        // Conta apenas os empréstimos ativos
        $documentosEmprestados = Emprestimo::where('status', 'Emprestado')->count();
        
        $totalGavetas = Gaveta::count();

        // Pega nos últimos 5 documentos arquivados para a tabela rápida
        $documentosRecentes = Documento::with(['aluno', 'curso', 'assunto', 'gaveta.armario'])
                                     ->latest()
                                     ->take(5)
                                     ->get();

        return view('dashboard', compact('totalDocumentos', 'documentosEmprestados', 'totalGavetas', 'documentosRecentes'));
    }
}