<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServicioEvento extends Model
{
    protected $fillable = [
        'servicio_id',
        'evento_id',
        'tipo_servicio_id',
    ];


    public function servicio()
    {
        return $this->belongsTo(Servicio::class);
    }

    public function Evento()
    {
        return $this->belongsTo(Evento::class);
    }

    public function tipoServicio()
    {
        return $this->belongsTo(Tipo_Servicio::class, 'tipo_servicio_id');
    }
}
