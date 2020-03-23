<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grado extends Model
{
    protected $table = 'grado';

    protected $fillable = ['abreviatura','descripcion', 'carrera_id',
    'users_id', 'created_at', 'updated_at'];
}
