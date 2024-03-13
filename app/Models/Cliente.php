<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'apellidos',
        'telefono',
        'email',
        'observaciones'
    ];

    public function reservas() {
        return $this->hasMany(Reserva::class);
    }

    public function ventas() {
        return $this->hasMany(Venta::class);
    }
}
