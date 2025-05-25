<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Solicitud extends Model
{
    use HasFactory;
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
    public function servicios()
    {
        return $this->belongsToMany(Servicio::class, 'servicio_solicituds', 'solicitud_id', 'servicio_id')
            ->withPivot('tipo_servicio_id');
    }
    public function seguimientos()
    {
        return $this->hasMany(SeguimientoSolicitud::class);
    }
}
