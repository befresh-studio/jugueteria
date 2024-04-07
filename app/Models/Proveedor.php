<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    use HasFactory;

    protected $table = 'proveedores';

    protected $fillable = [
        'nombre',
        'email',
        'cif',
        'telefono',
        'observaciones'
    ];

    public function compras() {
        return $this->hasMany(Compra::class);
    }

    public function juguetes() {
        return $this->belongsToMany(Juguete::class, 'juguetes_proveedores', 'proveedores_id', 'juguetes_id');
    }

    public function ultimoPrecioCompra(int $id_juguete) {
        $compra = Compra::whereHas('juguetes', function($q) use ($id_juguete) {
            $q->where('juguetes.id', $id_juguete);
        })->latest()->first();

        foreach($compra->juguetes as $juguete_comprado) {
            if($juguete_comprado->id == $id_juguete) {
                return $juguete_comprado->pivot->precio_unitario;
            }
        }
    }
}
