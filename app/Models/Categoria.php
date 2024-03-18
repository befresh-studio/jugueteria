<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre'
    ];

    public function juguetes() {
        return $this->belongsToMany(Juguete::class, 'categorias_juguetes', 'categorias_id', 'juguetes_id');
    }
}
