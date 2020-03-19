<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tipodemanda extends Model
{
    protected $table = 'tipodemanda';

    protected $fillable = ['abreviatura','descripcion','comentario', 'users_id', 
    'created_at', 'updated_at'];
}
