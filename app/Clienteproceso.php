<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Clienteproceso extends Model
{
    protected $table = 'clienteproceso';

    protected $fillable = ['personanatural_id','proceso_id', 'tipodemanda_id',
    'users_id', 'created_at', 'updated_at'];
}
