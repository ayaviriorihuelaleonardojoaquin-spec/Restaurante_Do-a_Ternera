<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Platillo extends Model
{
    //
    use HasFactory;

    protected $table = 'platillos';

    protected $fillable = [
        'producto_id',
        'tipo_precio',
        'precio',
        'fecha_desde',
        'fecha_hasta',
        'estado',
        'eliminado',
    ];

}
