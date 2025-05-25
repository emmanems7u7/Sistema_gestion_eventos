<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Imagen extends Model
{
    protected $table = 'imagenes';
    protected $fillable = [
        'inventario_id',
        'ruta',
        'tipo',
    ];

    public function inventario()
    {
        return $this->belongsTo(Inventario::class);
    }
}
