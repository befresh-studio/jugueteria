<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    use HasFactory;

    protected $fillable = [
        'referencia',
        'fecha_entrega',
        'importe_total',
        'iva',
        'proveedores_id'
    ];

    public function proveedor() {
        return $this->belongsTo(Proveedor::class, 'proveedores_id');
    }

    public function juguetes() {
        return $this->belongsToMany(Juguete::class, 'compras_juguetes', 'compras_id', 'juguetes_id')->withPivot('precio_unitario', 'iva_total', 'cantidad', 'importe_total')->withTimestamps();
    }

    public function estados() {
        return $this->belongsToMany(EstadoCompra::class, 'compras_estados_compras', 'compras_id', 'estado_compras_id');
    }
}
