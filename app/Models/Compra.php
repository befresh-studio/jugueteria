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
}
