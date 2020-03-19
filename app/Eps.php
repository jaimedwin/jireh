<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Eps extends Model
{
    protected $table = 'eps';

    protected $fillable = ['abreviatura','descripcion', 'users_id', 
    'created_at', 'updated_at'];
}
