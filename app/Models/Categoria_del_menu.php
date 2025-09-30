<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Categoria_del_menu extends Model
{
    //
    use HasFactory;

    protected $table = 'categorias_del_menu';

    protected $fillable = [
        'nombre',
        'descripcion',
        'estado',
        'eliminado'
    ];

}
