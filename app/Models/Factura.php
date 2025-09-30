<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    use HasFactory;

    protected $fillable = [
        'pedido_id',
        'cliente',
        'monto_total',
        'metodo_pago',
    ];

    // Relación: Factura pertenece a un Pedido
    public function pedido()
    {
        return $this->belongsTo(Pedido::class);
    }
}
