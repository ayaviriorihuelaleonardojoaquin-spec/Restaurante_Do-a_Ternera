<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Tipo_de_platos extends Model
{
    //
    use HasFactory;

    protected $table = 'tipos_de_platos';

    protected $fillable = [
        'nombre',
        'descripcion',
        'estado',
        'eliminado'
    ];

}
