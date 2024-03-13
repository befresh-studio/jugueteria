<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstadoVenta extends Model
{
    use HasFactory;

    protected $fillable = [
        'estado',
        'color'
    ];

    public function ventas() {
        return $this->belongsToMany(Venta::class);
    }
}
