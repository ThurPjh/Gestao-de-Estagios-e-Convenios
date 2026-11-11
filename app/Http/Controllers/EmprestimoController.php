<?php

namespace App\Http\Controllers;

use App\Models\Emprestimo;
use App\Models\Documento;
use App\Models\User;
use Illuminate\Http\Request;

class EmprestimoController extends Controller
{
    public function index(Request $request)
    {
        // Inicia a query chamando os relacionamentos necessários
        $query = \App\Models\Emprestimo::with(['documento.aluno', 'user'])->latest();

        // 1. Filtro por Status (Emprestado ou Devolvido)
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // 2. Campo de Busca Geral (ID, Título, Matrícula ou Nome do Aluno)
        if ($request->filled('search')) {
            $search = $request->search;
            
            $query->where(function($q) use ($search) {
                // Busca por ID exato
                $q->where('id', $search)
                  // Ou busca dentro da tabela de documentos relacionados
                  ->orWhereHas('documento', function($qDoc) use ($search) {
                      $qDoc->where('titulo_documento', 'like', "%{$search}%")
                           // Ou busca dentro da tabela de alunos vinculada ao documento
                           ->orWhereHas('aluno', function($qAluno) use ($search) {
                               $qAluno->where('matricula_aluno', 'like', "%{$search}%")
                                      ->orWhere('nome_aluno', 'like', "%{$search}%");
                           });
                  });
            });
        }

        // Puxa os resultados filtrados
        $emprestimos = $query->get();

        return view('emprestimos.index', compact('emprestimos'));
    }

    public function create() {
        $documentos = Documento::all();
        $users = User::all();
        return view('emprestimos.create', compact('documentos', 'users'));
    }

    public function store(Request $request) {
        $request->validate([
            'documento_id' => 'required',
            'user_id' => 'required',
            'data_emprestimo' => 'required|date'
        ]);

        Emprestimo::create($request->all());
        return redirect()->route('emprestimos.index')->with('sucesso', 'Empréstimo registado!');
    }
    
    public function devolver($id)
    {
        $emprestimo = \App\Models\Emprestimo::findOrFail($id);
        
        // Atualiza o status e regista a data de devolução como hoje
        $emprestimo->status = 'Devolvido';
        $emprestimo->data_devolucao = \Carbon\Carbon::now();
        $emprestimo->save();

        return redirect()->route('emprestimos.index')->with('sucesso', 'Documento devolvido com sucesso!');
    }
}