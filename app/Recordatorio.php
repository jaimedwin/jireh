<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recordatorio extends Model
{
    protected $table = 'recordatorio';

    protected $fillable = ['observacion','fecha', 
    'users_id', 'created_at', 'updated_at'];
}
