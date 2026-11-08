<?php
namespace App\Http\Controllers;
use App\Models\Curso;
use Illuminate\Http\Request;

class CursoController extends Controller
{
    public function index() {
        $cursos = Curso::all();
        return view('cursos.index', compact('cursos'));
    }
    public function create() {
        return view('cursos.create');
    }
    public function store(Request $request) {
        $request->validate(['nome_curso' => 'required|string|max:255']);
        Curso::create($request->all());
        return redirect()->route('cursos.index')->with('sucesso', 'Curso registado com sucesso!');
    }
}