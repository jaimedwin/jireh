<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tipodocumento extends Model
{
    protected $table = 'tipodocumento';

    protected $fillable = ['abreviatura','descripcion','comentario', 'users_id', 
    'created_at', 'updated_at']; 
}
