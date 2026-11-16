<?php

namespace App\Http\Controllers;

use App\Models\Documento;
use App\Models\Emprestimo;
use App\Models\Gaveta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Necessário para os cálculos dos gráficos

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Totais dos Cartões
        $totalDocumentos = Documento::count();
        $documentosEmprestados = Emprestimo::where('status', 'Emprestado')->count();
        $totalGavetas = Gaveta::count();

        // 2. Últimos 5 documentos para a tabela
        $documentosRecentes = Documento::with(['aluno', 'curso', 'assunto', 'gaveta.armario'])
                                     ->latest()
                                     ->take(5)
                                     ->get();

        // 3. DADOS PARA O GRÁFICO 1 (Documentos por Curso)
        $docsPorCurso = Documento::with('curso')
            ->select('curso_id', DB::raw('count(*) as total'))
            ->groupBy('curso_id')
            ->get();
        
        $labelsCursos = $docsPorCurso->pluck('curso.nome_curso')->toJson();
        $dadosCursos = $docsPorCurso->pluck('total')->toJson();

        // 4. DADOS PARA O GRÁFICO 2 (Volume por Armário)
        $docsPorArmario = DB::table('documentos')
            ->join('gavetas', 'documentos.gaveta_id', '=', 'gavetas.id')
            ->join('armarios', 'gavetas.armario_id', '=', 'armarios.id')
            ->select('armarios.identificacao', DB::raw('count(documentos.id) as total'))
            ->groupBy('armarios.identificacao')
            ->get();
            
        $labelsArmarios = $docsPorArmario->pluck('identificacao')->toJson();
        $dadosArmarios = $docsPorArmario->pluck('total')->toJson();

        return view('dashboard', compact(
            'totalDocumentos', 
            'documentosEmprestados', 
            'totalGavetas', 
            'documentosRecentes',
            'labelsCursos',
            'dadosCursos',
            'labelsArmarios',
            'dadosArmarios'
        ));
    }
}