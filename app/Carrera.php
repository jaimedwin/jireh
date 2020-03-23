<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Carrera extends Model
{
    protected $table = 'carrera';

    protected $fillable = ['abreviatura','descripcion', 'fuerza_id',
    'users_id', 'created_at', 'updated_at'];
}
