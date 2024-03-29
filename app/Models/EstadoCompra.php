<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstadoCompra extends Model
{
    use HasFactory;

    protected $fillable = [
        'estado',
        'color'
    ];

    public function compras() {
        return $this->belongsToMany(Compra::class);
    }
}
