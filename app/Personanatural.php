<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Personanatural extends Model
{
    protected $table = 'personanatural';

    protected $fillable = ['codigo', 'nombres', 
    'apellidopaterno', 'apellidomaterno',
    'tipodocumentoidentificacion_id',
    'numerodocumento', 'expedicion_id',
    'fechaexpedicion', 'fechanacimiento','direccion', 
    'eps_id', 'fondodepension_id', 'grado_id',
    'users_id', 'created_at', 'updated_at'];
}
