<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use App\Models\Documento;
use App\Models\Gaveta;
use App\Models\Curso;
use App\Models\Assunto;
use App\Models\Aluno;
use App\Models\Armario;
use Illuminate\Http\Request;

class DocumentoController extends Controller
{
    public function index(Request $request)
    {
        $query = Documento::with(['aluno', 'curso', 'assunto', 'gaveta.armario'])->latest();

        // 1. Busca por texto (ID, Título, Matrícula ou Nome do Aluno)
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('id', $search)
                  ->orWhere('titulo_documento', 'like', "%{$search}%")
                  ->orWhereHas('aluno', function ($qAluno) use ($search) {
                      $qAluno->where('matricula_aluno', 'like', "%{$search}%")
                             ->orWhere('nome_aluno', 'like', "%{$search}%");
                  });
            });
        }

        // 2. Filtro por Curso
        if ($request->filled('curso_id')) {
            $query->where('curso_id', $request->curso_id);
        }

        // 3. Filtro por Assunto
        if ($request->filled('assunto_id')) {
            $query->where('assunto_id', $request->assunto_id);
        }

        // 4. Filtro por Armário (via relacionamento com Gaveta)
        if ($request->filled('armario_id')) {
            $query->whereHas('gaveta', function ($qGaveta) use ($request) {
                $qGaveta->where('armario_id', $request->armario_id);
            });
        }

        $documentos = $query->paginate(50)->withQueryString();

        // Listas para popular os selects de filtro
        $cursos = Curso::orderBy('nome_curso')->get();
        $assuntos = Assunto::orderBy('nome_assunto')->get();
        $armarios = Armario::orderBy('identificacao')->get();

        return view('documentos.index', compact('documentos', 'cursos', 'assuntos', 'armarios'));
    }

    public function create() {
        $gavetas = Gaveta::with('armario')->get();
        $cursos = Curso::all();
        $assuntos = Assunto::all();
        $alunos = Aluno::all();
        
        return view('documentos.create', compact('gavetas', 'cursos', 'assuntos', 'alunos'));
    }

    public function store(Request $request){

    $dados = $request->validate([
        'titulo_documento' => 'required|string|max:255',
        'aluno_id' => 'required|exists:alunos,id',
        'curso_id' => 'required|exists:cursos,id',
        'assunto_id' => 'required|exists:assuntos,id',
        'gaveta_id' => 'required|exists:gavetas,id',
        'observacoes' => 'nullable|string',
        'arquivo_pdf' => 'nullable|file|mimes:pdf|max:10240', // Máx 10MB
    ]);

    if ($request->hasFile('arquivo_pdf')) {
        $dados['arquivo_pdf'] = $request->file('arquivo_pdf')->store('documentos_pdfs', 'public');
    }

    Documento::create($dados);

    return redirect()->route('documentos.index')->with('sucesso', 'Documento arquivado com sucesso!');
    }

    public function show($id){
    $documento = Documento::with(['aluno', 'curso', 'assunto', 'gaveta.armario'])->findOrFail($id);

    return view('documentos.show', compact('documento'));
    }

    public function edit($id)
    {
        $documento = Documento::findOrFail($id);
        $alunos = Aluno::orderBy('nome_aluno')->get();
        $cursos = Curso::orderBy('nome_curso')->get();
        $assuntos = Assunto::orderBy('nome_assunto')->get();
        $gavetas = Gaveta::with('armario')->get();

        return view('documentos.edit', compact('documento', 'alunos', 'cursos', 'assuntos', 'gavetas'));
    }

    public function update(Request $request, $id)
    {
        $documento = Documento::findOrFail($id);

        $dados = $request->validate([
            'titulo_documento' => 'required|string|max:255',
            'aluno_id' => 'required|exists:alunos,id',
            'curso_id' => 'required|exists:cursos,id',
            'assunto_id' => 'required|exists:assuntos,id',
            'gaveta_id' => 'required|exists:gavetas,id',
            'observacoes' => 'nullable|string',
            'arquivo_pdf' => 'nullable|file|mimes:pdf|max:10240',
        ]);

        if ($request->hasFile('arquivo_pdf')) {
            // Remove o PDF anterior do armazenamento se existir
            if ($documento->arquivo_pdf && Storage::disk('public')->exists($documento->arquivo_pdf)) {
                Storage::disk('public')->delete($documento->arquivo_pdf);
            }
            $dados['arquivo_pdf'] = $request->file('arquivo_pdf')->store('documentos_pdfs', 'public');
        }

        $documento->update($dados);

        return redirect()->route('documentos.show', $documento->id)->with('sucesso', 'Documento atualizado com sucesso!');
    }

    public function destroy($id)
    {
        $documento = Documento::findOrFail($id);

        // Bloqueia exclusão se o documento estiver emprestado no momento
        if ($documento->emprestimos()->where('status', 'Emprestado')->exists()) {
            return back()->with('erro', 'Não é possível excluir um documento que está atualmente emprestado.');
        }

        if ($documento->arquivo_pdf && Storage::disk('public')->exists($documento->arquivo_pdf)) {
            Storage::disk('public')->delete($documento->arquivo_pdf);
        }

        $documento->delete();

        return redirect()->route('documentos.index')->with('sucesso', 'Documento excluído com sucesso!');
    }
}