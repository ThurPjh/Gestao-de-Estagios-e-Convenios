<?php

namespace App\Http\Controllers;

use App\Models\Emprestimo;
use App\Models\Documento;
use App\Models\User;
use Illuminate\Http\Request;

class EmprestimoController extends Controller
{
    public function index() {
        $emprestimos = Emprestimo::with(['documento', 'user'])->get();
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
}