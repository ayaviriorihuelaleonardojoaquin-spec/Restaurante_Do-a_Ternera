<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Transaccion extends Model
{
    //
    use HasFactory;

    protected $table = 'transacciones';

    protected $fillable = [
        'tipo',
        'persona_id',
        'fecha',
        'nombre_comprobante',
        'numero_comprobante',
        'user_id',
        'total',
        'estado',
        'eliminado'
    ];

}
