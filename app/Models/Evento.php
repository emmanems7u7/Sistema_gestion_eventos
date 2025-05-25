<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    protected $fillable = [
        'titulo',
        'descripcion',
        'fecha',
        'hora_inicio',
        'hora_fin',
        'ubicacion',
        'geolocalizacion',
        'estado',
        'estado_aprobacion',
    ];

    public function usuarios()
    {
        return $this->belongsToMany(User::class);
    }
}
