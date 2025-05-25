<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventoUsuario extends Model
{

    protected $fillable = [
        'evento_id',
        'user_id',
        'fecha',
        'hora_inicio',
        'hora_fin',
    ];

}
