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
        return $this->belongsTo(Cliente::class);
    }

    public function juguetes() {
        return $this->belongsToMany(Juguete::class);
    }
}
