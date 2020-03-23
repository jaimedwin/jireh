<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Registroconsulta extends Model
{
    protected $table = 'registroconsulta';

    protected $fillable = ['personanatural_id','proceso_id', 
    'users_id', 'created_at', 'updated_at'];
}
