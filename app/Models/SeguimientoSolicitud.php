<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SeguimientoSolicitud extends Model
{
    protected $fillable = [
        'solicitud_id',
        'mensaje',
    ];
    public function solicitud()
    {
        return $this->belongsTo(Solicitud::class);
    }
}
