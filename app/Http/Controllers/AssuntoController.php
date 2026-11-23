<?php

namespace App\Http\Controllers;

use App\Models\Assunto;
use Illuminate\Http\Request;

class AssuntoController extends Controller
{
    public function index(Request $request)
    {
        $query = Assunto::withCount('documentos')->orderBy('nome_assunto');

        if ($request->filled('search')) {
            $query->where('nome_assunto', 'like', "%{$request->search}%");
        }

        $assuntos = $query->paginate(30)->withQueryString();

        return view('assuntos.index', compact('assuntos'));
    }

    public function create()
    {
        return view('assuntos.create');
    }

    public function store(Request $request)
    {
        $dados = $request->validate([
            'nome_assunto' => 'required|string|max:255|unique:assuntos,nome_assunto',
        ], [
            'nome_assunto.unique' => 'Já existe um assunto cadastrado com este nome.',
        ]);

        Assunto::create($dados);

        return redirect()->route('assuntos.index')->with('sucesso', 'Assunto cadastrado com sucesso.');
    }

    public function edit($id)
    {
        $assunto = Assunto::findOrFail($id);
        return view('assuntos.edit', compact('assunto'));
    }

    public function update(Request $request, $id)
    {
        $assunto = Assunto::findOrFail($id);

        $dados = $request->validate([
            'nome_assunto' => 'required|string|max:255|unique:assuntos,nome_assunto,' . $id,
        ], [
            'nome_assunto.unique' => 'Já existe outro assunto cadastrado com este nome.',
        ]);

        $assunto->update($dados);

        return redirect()->route('assuntos.index')->with('sucesso', 'Assunto atualizado com sucesso.');
    }
}