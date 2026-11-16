<?php

namespace App\Http\Controllers;

use App\Models\Armario;
use Illuminate\Http\Request;

class ArmarioController extends Controller
{
    // Mostra a lista de armários
    public function index()
    {
        $armarios = Armario::all();
        return view('armarios.index', compact('armarios'));
    }

    // Mostra o formulário para criar um novo
    public function create()
    {
        return view('armarios.create');
    }

    // Salva o armário no banco de dados
    public function store(Request $request)
    {
        $request->validate([
            'identificacao' => 'required|string|max:255',
        ]);

        Armario::create($request->all());

        return redirect()->route('armarios.index')->with('sucesso', 'Armário registado com sucesso!');
    }
}