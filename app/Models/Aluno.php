<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Aluno extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'matricula_aluno',
        'nome_aluno'
    ];

    public function documentos()
    {
        return $this->hasMany(Documento::class);
    }
}