<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Servicio extends Model
{
    protected $fillable = ['nombre', 'descripcion', 'imagen', 'role_id', 'inventario_id'];

    public function tipos(): HasMany
    {
        return $this->hasMany(Tipo_Servicio::class);
    }
    public function solicitudes()
    {
        return $this->belongsToMany(Solicitud::class, 'servicio_solicituds', 'servicio_id', 'solicitud_id')
            ->withPivot('tipo_servicio_id');
    }

}

