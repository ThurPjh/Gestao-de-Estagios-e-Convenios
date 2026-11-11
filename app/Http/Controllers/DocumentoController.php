<?php

namespace App\Http\Controllers;

use App\Models\Documento;
use App\Models\Gaveta;
use App\Models\Curso;
use App\Models\Assunto;
use App\Models\Aluno;
use Illuminate\Http\Request;

class DocumentoController extends Controller
{
    public function index(Request $request)
    {
        // Inicia a query chamando todos os relacionamentos para evitar lentidão
        $query = \App\Models\Documento::with(['aluno', 'curso', 'assunto', 'gaveta.armario'])->latest();

        // Verifica se há alguma pesquisa
        if ($request->filled('search')) {
            $search = $request->search;
            
            $query->where(function($q) use ($search) {
                // Busca pelo ID exato
                $q->where('id', $search)
                  // Ou pelo título do documento
                  ->orWhere('titulo_documento', 'like', "%{$search}%")
                  // Ou pelo nome/matrícula do aluno
                  ->orWhereHas('aluno', function($qAluno) use ($search) {
                      $qAluno->where('matricula_aluno', 'like', "%{$search}%")
                             ->orWhere('nome_aluno', 'like', "%{$search}%");
                  })
                  // Ou pelo nome do curso
                  ->orWhereHas('curso', function($qCurso) use ($search) {
                      $qCurso->where('nome_curso', 'like', "%{$search}%");
                  })
                  // Ou pelo nome do assunto
                  ->orWhereHas('assunto', function($qAssunto) use ($search) {
                      $qAssunto->where('nome_assunto', 'like', "%{$search}%");
                  });
            });
        }

        // Puxa os documentos filtrados
        $documentos = $query->get();

        return view('documentos.index', compact('documentos'));
    }

    public function create() {
        $gavetas = Gaveta::with('armario')->get();
        $cursos = Curso::all();
        $assuntos = Assunto::all();
        $alunos = Aluno::all();
        
        return view('documentos.create', compact('gavetas', 'cursos', 'assuntos', 'alunos'));
    }

    public function store(Request $request) {
        $request->validate([
            'gaveta_id' => 'required',
            'curso_id' => 'required',
            'assunto_id' => 'required',
            'aluno_id' => 'required',
            'titulo_documento' => 'required|string|max:255'
        ]);

        Documento::create($request->all());
        return redirect()->route('documentos.index')->with('sucesso', 'Documento arquivado com sucesso!');
    }
}