<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    protected $fillable = [
        'mesa_id',
        'mesero_id',
        'estado',
        'total',
        'observaciones',
        'tipo',
        'nombre',
        'cliente_id',
        'estado',
    ];

    public function mesa()
    {
        return $this->belongsTo(Mesa::class);
    }

    public function mesero()
    {
        return $this->belongsTo(User::class, 'mesero_id');
    }

    public function detallePedidos()
    {
        return $this->hasMany(DetallePedido::class);
    }

    public function cliente()
    {
        return $this->belongsTo(User::class, 'cliente_id');
    }

    public function platos()
    {
        return $this->belongsToMany(Plato::class, 'pedido_plato');
    }
    public function factura()
{
    return $this->hasOne(Factura::class);
}
}