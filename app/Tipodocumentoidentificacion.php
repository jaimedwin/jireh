<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tipodocumentoidentificacion extends Model
{
    protected $table = 'tipodocumentoidentificacion';

    protected $fillable = ['abreviatura','descripcion', 'users_id', 
    'created_at', 'updated_at'];
}
