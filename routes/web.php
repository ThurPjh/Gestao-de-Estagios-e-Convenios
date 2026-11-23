<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArmarioController;
use App\Http\Controllers\GavetaController;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\AssuntoController;
use App\Http\Controllers\AlunoController;
use App\Http\Controllers\DocumentoController;
use App\Http\Controllers\EmprestimoController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;

// Rotas Públicas (Login e Logout)
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Rotas Protegidas (Exigem Autenticação)
Route::middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('armarios', ArmarioController::class);
    Route::resource('gavetas', GavetaController::class);
    Route::resource('cursos', CursoController::class);
    Route::resource('assuntos', AssuntoController::class);
    Route::resource('alunos', AlunoController::class);
    Route::resource('documentos', DocumentoController::class);
    Route::resource('emprestimos', EmprestimoController::class);
    Route::resource('usuarios', UserController::class)->except(['show']);

    Route::put('/emprestimos/{id}/devolver', [EmprestimoController::class, 'devolver'])->name('emprestimos.devolver');
});