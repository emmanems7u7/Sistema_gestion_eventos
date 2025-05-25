<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Inventario extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombre',
        'descripcion',
        'cantidad_disponible',
        'categoria',
        'frecuencia_mantenimiento',
        'fecha_adquisicion',
        'estado',
    ];


    public function imagenes()
    {
        return $this->hasMany(Imagen::class);
    }
}
