<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Tipo_Servicio extends Model
{
    protected $fillable = [
        'servicio_id',
        'tipo',
        'caracteristicas',
        'precio',
        'catalogo_id',
        'cantidad_personal',
        'cantidad_equipo',
        'categoria_id',
        'inventario_id'
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }
}