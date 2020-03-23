<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Telefono extends Model
{
    protected $table = 'telefono';

    protected $fillable = ['prefijo', 'numero',
    'principal', 'personanatural_id',
    'users_id', 'created_at', 'updated_at'];
}
