<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    use HasFactory;

    protected $table = 'roles';

    protected $fillable = [
        'nombre',
        'descripcion',
    ];

    /**
     * Relación: un rol tiene muchos usuarios
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
