<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SolicitudUsuario extends Model
{
    protected $fillable = [
        'solicitud_id',
        'user_id',
        'fecha',
        'hora_inicio',
        'hora_fin',
    ];
}
