<?php
namespace App\Http\Controllers;
use App\Models\Assunto;
use Illuminate\Http\Request;

class AssuntoController extends Controller
{
    public function index() {
        $assuntos = Assunto::all();
        return view('assuntos.index', compact('assuntos'));
    }
    public function create() {
        return view('assuntos.create');
    }
    public function store(Request $request) {
        $request->validate(['nome_assunto' => 'required|string|max:255']);
        Assunto::create($request->all());
        return redirect()->route('assuntos.index')->with('sucesso', 'Assunto registado com sucesso!');
    }
}