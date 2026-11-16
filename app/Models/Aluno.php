<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Aluno extends Model
{


    protected $fillable = [
        'matricula_aluno',
        'nome_aluno'
    ];

    public function documentos()
    {
        return $this->hasMany(Documento::class);
    }
}