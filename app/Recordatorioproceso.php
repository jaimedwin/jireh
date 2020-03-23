<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recordatorioproceso extends Model
{
    protected $table = 'recordatorio';

    protected $fillable = ['observacion','fecha', 'proceso_id',
    'users_id', 'created_at', 'updated_at'];
}
