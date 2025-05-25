<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $fillable = ['nombre', 'ape_pat', 'ape_mat', 'email', 'telefono', 'solicitud_id'];
}
