<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServicioSolicitud extends Model
{
    protected $fillable = [
        'servicio_id',
        'solicitud_id',
        'tipo_servicio_id',
    ];


    public function servicio()
    {
        return $this->belongsTo(Servicio::class);
    }

    public function solicitud()
    {
        return $this->belongsTo(Solicitud::class);
    }

    public function tipoServicio()
    {
        return $this->belongsTo(Tipo_Servicio::class, 'tipo_servicio_id');
    }
}
