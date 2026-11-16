<?php

namespace App\Http\Controllers;

use App\Models\Aluno;
use Illuminate\Http\Request;

class AlunoController extends Controller
{
    public function index() {
        $alunos = Aluno::all();
        return view('alunos.index', compact('alunos'));
    }

    public function create() {
        return view('alunos.create');
    }

    public function store(Request $request)
    {
    $dados = $request->validate([
        'matricula_aluno' => 'required|string|max:50|unique:alunos,matricula_aluno',
        'nome_aluno' => 'required|string|max:255',
    ], [
        'matricula_aluno.unique' => 'Já existe um aluno cadastrado com esta matrícula.',
    ]);

    Aluno::create($dados);

    return redirect()->route('alunos.index')->with('sucesso', 'Aluno cadastrado com sucesso!');
    }
}