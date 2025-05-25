<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $fillable = ['nombre', 'descripcion', 'estado'];

    public function catalogos()
    {
        return $this->hasMany(Catalogo::class);
    }
    public function tiposServicio()
    {
        return $this->hasMany(Tipo_Servicio::class, 'categoria_id');
    }
}
