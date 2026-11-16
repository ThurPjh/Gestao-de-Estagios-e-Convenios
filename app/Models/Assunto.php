<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Assunto extends Model
{
    protected $fillable = [
        'nome_assunto'
    ];

    public function documentos()
    {
        return $this->hasMany(Documento::class);
    }
}