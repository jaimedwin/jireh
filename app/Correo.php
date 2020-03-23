<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Correo extends Model
{
    protected $table = 'correo';

    protected $fillable = ['electronico','principal', 'personanatural_id',
    'users_id', 'created_at', 'updated_at'];
}
