<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class DetalleTransaccion extends Model
{
    //
    use HasFactory;

    protected $table = 'detalle_transacciones';

    protected $fillable = [
        'transaccion_id',
        'producto_id',
        'lote_id',
        'cantidad',
        'precio_unitario',
        'subtotal',
    ];

}
