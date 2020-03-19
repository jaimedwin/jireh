<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tipocontrato extends Model
{
    protected $table = 'tipocontrato';

    protected $fillable = ['descripcion', 'users_id', 
    'created_at', 'updated_at'];
}
