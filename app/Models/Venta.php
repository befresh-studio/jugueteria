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
        return $this->belongsToMany(EstadoVenta::class, 'estados_ventas_ventas', 'ventas_id', 'estado_ventas_id');
    }

    public function juguetes() {
        return $this->belongsToMany(Juguete::class, 'juguetes_ventas', 'ventas_id', 'juguetes_id')->withPivot('precio_unitario', 'iva_total', 'cantidad', 'importe_total')->withTimestamps();
    }
}
