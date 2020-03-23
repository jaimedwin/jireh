<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contrato extends Model
{
    protected $table = 'contrato';

    protected $fillable = ['ruta','valor', 
    'personanatural_id', 'tipocontrato_id',
    'users_id', 'created_at', 'updated_at'];
}
