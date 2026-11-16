<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Emprestimo extends Model
{
    protected $fillable = [
        'documento_id',
        'user_id',
        'data_emprestimo',
        'data_devolucao',
        'status'
    ];

    public function documento() { return $this->belongsTo(Documento::class); }
    public function user() { return $this->belongsTo(User::class); }
}