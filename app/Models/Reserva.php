<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    use HasFactory;

    protected $fillable = [
        'importe_total',
        'importe_pagado',
        'clientes_id'
    ];

    public function cliente() {
        return $this->belongsTo(Cliente::class, 'clientes_id');
    }

    public function juguetes() {
        return $this->belongsToMany(Juguete::class, 'juguetes_reservas', 'reservas_id', 'juguetes_id')->withPivot('precio_unitario', 'iva_total', 'cantidad', 'importe_total')->withTimestamps();
    }
}
