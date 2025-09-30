<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Personal extends Model
{
    //
    use HasFactory;

    protected $table = 'personas';

    protected $fillable = [
        'nombre',
        'direccion',
        'telefono',
        'email',
        'tipo',
        'estado',
        'eliminado',
    ];

}
