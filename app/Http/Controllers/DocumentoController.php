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
    public function index() {
        // Trazemos o documento já com todas as suas relações para mostrar na tabela
        $documentos = Documento::with(['gaveta.armario', 'curso', 'assunto', 'aluno'])->get();
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