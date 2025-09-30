<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Mesas extends Model
{
    //
    use HasFactory;

    protected $table = 'mesas';

    protected $fillable = [
        'numero',
        'descripcion',
        'estado',
        'eliminado'
    ];

}
