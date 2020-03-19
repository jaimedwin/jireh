<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fuerza extends Model
{
    protected $table = 'fuerza';

    protected $fillable = ['abreviatura','descripcion', 'users_id', 
    'created_at', 'updated_at'];
}
