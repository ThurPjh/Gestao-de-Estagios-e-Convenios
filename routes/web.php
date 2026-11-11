<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArmarioController;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\AssuntoController;
use App\Http\Controllers\AlunoController;
use App\Http\Controllers\DocumentoController;
use App\Http\Controllers\EmprestimoController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return redirect()->route('armarios.index'); // Redireciona a página inicial direto para os armários
});

// Cria automaticamente todas as rotas do CRUD (listar, criar, editar, apagar)
Route::resource('armarios', ArmarioController::class);

Route::resource('gavetas', App\Http\Controllers\GavetaController::class);

Route::resource('cursos', CursoController::class);

Route::resource('assuntos', AssuntoController::class);

Route::resource('alunos', AlunoController::class);

Route::resource('documentos', DocumentoController::class);

Route::resource('emprestimos', EmprestimoController::class);

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::put('/emprestimos/{id}/devolver', [App\Http\Controllers\EmprestimoController::class, 'devolver'])->name('emprestimos.devolver');