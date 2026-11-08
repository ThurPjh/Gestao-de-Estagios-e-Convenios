<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Armario extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'identificacao'
    ];

    public function gavetas()
    {
        return $this->hasMany(Gaveta::class);
    }
}