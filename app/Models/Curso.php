<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Curso extends Model
{


    protected $fillable = [
        'nome_curso'
    ];

    public function documentos()
    {
        return $this->hasMany(Documento::class);
    }
}