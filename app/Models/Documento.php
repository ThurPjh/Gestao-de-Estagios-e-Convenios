<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Documento extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'ano',
        'caminho_pdf',
        'status',
        'gaveta_id',
        'curso_id',
        'assunto_id',
        'aluno_id',
        'user_id'
    ];

    // Relações de Pertencimento (Chaves Estrangeiras)
    public function gaveta() { return $this->belongsTo(Gaveta::class); }
    public function curso() { return $this->belongsTo(Curso::class); }
    public function assunto() { return $this->belongsTo(Assunto::class); }
    public function aluno() { return $this->belongsTo(Aluno::class); }
    public function user() { return $this->belongsTo(User::class); } // O utilizador que registou

    // Um documento pode ter vários empréstimos ao longo do tempo
    public function emprestimos()
    {
        return $this->hasMany(Emprestimo::class);
    }
}