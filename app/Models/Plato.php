<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plato extends Model
{
    use HasFactory;

    protected $table = 'platos';

    protected $fillable = [
        'nombre',
        'descripcion',
        'precio',
        'disponible',
        'imagen',
        'estado',
    ];

    protected $casts = [
        'disponible' => 'boolean',
        'precio' => 'decimal:2',
    ];

    public function detalles()
    {
        return $this->hasMany(DetallePedido::class);
    }
}
