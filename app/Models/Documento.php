<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Documento extends Model
{
    protected $fillable = [
        'gaveta_id',
        'curso_id',
        'assunto_id',
        'aluno_id',
        'titulo_documento',
        'observacoes'
    ];

    public function gaveta() { return $this->belongsTo(Gaveta::class); }
    public function curso() { return $this->belongsTo(Curso::class); }
    public function assunto() { return $this->belongsTo(Assunto::class); }
    public function aluno() { return $this->belongsTo(Aluno::class); }

    // Um documento pode ter vários empréstimos ao longo do tempo
    public function emprestimos()
    {
        return $this->hasMany(Emprestimo::class);
    }
}