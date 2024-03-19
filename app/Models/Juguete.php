<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Juguete extends Model
{
    use HasFactory;

    protected $fillable = [
        'imagen',
        'nombre',
        'referencia',
        'ean13',
        'precio',
        'stock'
    ];

    public function reservas() {
        return $this->belongsToMany(Reserva::class);
    }

    public function ventas() {
        return $this->belongsToMany(Venta::class, 'juguetes_ventas', 'ventas_id', 'juguetes_id')->withPivot('precio_unitario', 'iva_total', 'cantidad', 'importe_total')->withTimestamps();
    }

    public function categorias() {
        return $this->belongsToMany(Categoria::class, 'categorias_juguetes', 'juguetes_id', 'categorias_id');
    }

    public function compras() {
        return $this->belongsToMany(Compra::class);
    }

    public function proveedores() {
        return $this->belongsToMany(Proveedor::class);
    }
}
