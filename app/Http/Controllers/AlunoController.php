<?php

namespace App\Http\Controllers;

use App\Models\Aluno;
use Illuminate\Http\Request;

class AlunoController extends Controller
{
    public function index(Request $request)
    {
        $query = Aluno::withCount('documentos')->orderBy('nome_aluno');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nome_aluno', 'like', "%{$search}%")
                  ->orWhere('matricula_aluno', 'like', "%{$search}%");
            });
        }

        $alunos = $query->paginate(30)->withQueryString();

        return view('alunos.index', compact('alunos'));
    }

    public function create()
    {
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

        return redirect()->route('alunos.index')->with('sucesso', 'Aluno cadastrado com sucesso.');
    }

    public function edit($id)
    {
        $aluno = Aluno::findOrFail($id);
        return view('alunos.edit', compact('aluno'));
    }

    public function update(Request $request, $id)
    {
        $aluno = Aluno::findOrFail($id);

        $dados = $request->validate([
            'matricula_aluno' => 'required|string|max:50|unique:alunos,matricula_aluno,' . $id,
            'nome_aluno' => 'required|string|max:255',
        ], [
            'matricula_aluno.unique' => 'Já existe outro aluno cadastrado com esta matrícula.',
        ]);

        $aluno->update($dados);

        return redirect()->route('alunos.index')->with('sucesso', 'Dados do aluno atualizados com sucesso.');
    }
}