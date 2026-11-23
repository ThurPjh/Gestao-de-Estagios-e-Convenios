<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $usuarios = User::orderBy('name')->paginate(20);
        return view('usuarios.index', compact('usuarios'));
    }

    public function create()
    {
        return view('usuarios.create');
    }

    public function store(Request $request)
    {
        $dados = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ], [
            'email.unique' => 'Este e-mail já está cadastrado no sistema.',
            'password.confirmed' => 'A confirmação de senha não confere.',
            'password.min' => 'A senha deve ter no mínimo 6 caracteres.',
        ]);

        User::create([
            'name' => $dados['name'],
            'email' => $dados['email'],
            'password' => Hash::make($dados['password']),
        ]);

        return redirect()->route('usuarios.index')->with('sucesso', 'Operador cadastrado com sucesso.');
    }

    public function destroy($id)
    {
        if (auth()->id() == $id) {
            return back()->with('erro', 'Você não pode excluir o próprio usuário logado.');
        }

        User::findOrFail($id)->delete();

        return redirect()->route('usuarios.index')->with('sucesso', 'Operador removido com sucesso.');
    }
}