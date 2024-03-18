<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;

    protected $fillable = [
        'referencia',
        'importe_total',
        'iva',
        'clientes_id'
    ];

    public function cliente() {
        return $this->belongsTo(Cliente::class, 'clientes_id');
    }

    public function estados() {
        return $this->belongsToMany(EstadoVenta::class);
    }

    public function juguetes() {
        return $this->belongsToMany(Juguete::class);
    }
}
