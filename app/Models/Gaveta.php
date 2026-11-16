<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Gaveta extends Model
{
   

    protected $fillable = [
        'armario_id',
        'identificacao',
        'capacidade_maxima'
    ];

    // Uma gaveta pertence a um armário
    public function armario()
    {
        return $this->belongsTo(Armario::class);
    }

    // Uma gaveta guarda vários documentos
    public function documentos()
    {
        return $this->hasMany(Documento::class);
    }
}