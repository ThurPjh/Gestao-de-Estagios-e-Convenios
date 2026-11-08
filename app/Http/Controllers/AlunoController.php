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

    public function store(Request $request) {
        $request->validate([
            'matricula_aluno' => 'required|string|max:255',
            'nome_aluno' => 'required|string|max:255'
        ]);
        
        Aluno::create($request->all());
        
        return redirect()->route('alunos.index')->with('sucesso', 'Aluno registado com sucesso!');
    }
}