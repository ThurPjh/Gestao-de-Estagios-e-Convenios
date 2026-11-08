<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Armario extends Model
{
    

    protected $fillable = [
        'identificacao'
    ];

    public function gavetas()
    {
        return $this->hasMany(Gaveta::class);
    }
}