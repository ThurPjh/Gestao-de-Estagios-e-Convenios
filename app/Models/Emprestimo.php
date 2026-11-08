<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Emprestimo extends Model
{
    protected $fillable = [
        'status',
        'data_emprestimo',
        'data_devolucao',
        'documento_id',
        'user_id' // Quem requisitou a pasta
    ];

    // Converte os campos de data do banco para objetos Carbon no Laravel, facilitando a manipulação
    protected $casts = [
        'data_emprestimo' => 'datetime',
        'data_devolucao' => 'datetime',
        'status' => 'boolean'
    ];

    public function documento()
    {
        return $this->belongsTo(Documento::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}