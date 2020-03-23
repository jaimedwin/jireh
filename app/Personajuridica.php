<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Personajuridica extends Model
{
    protected $table = 'personajuridica';

    protected $fillable = ['nit', 'razonsocial', 
    'direccion', 'personanatural_id',
    'users_id', 'created_at', 'updated_at'];
}
