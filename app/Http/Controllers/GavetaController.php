<?php

namespace App\Http\Controllers;

use App\Models\Gaveta;
use App\Models\Armario;
use Illuminate\Http\Request;

class GavetaController extends Controller
{
    public function index()
    {
        // O "with" já traz os dados do armário associado para não sobrecarregar a base de dados
        $gavetas = Gaveta::with('armario')->get();
        return view('gavetas.index', compact('gavetas'));
    }

    public function create()
    {
        // Precisamos de todos os armários para preencher o <select> do formulário
        $armarios = Armario::all();
        return view('gavetas.create', compact('armarios'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'armario_id' => 'required|exists:armarios,id',
            'identificacao' => 'required|string|max:255',
            'capacidade_maxima' => 'nullable|integer'
        ]);

        Gaveta::create($request->all());

        return redirect()->route('gavetas.index')->with('sucesso', 'Gaveta registada com sucesso!');
    }
}