<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Documento extends Model
{
    protected $table = 'documento';

    protected $fillable = ['nombrearchivo',
    'tipodocumento_id', 'personanatural_id', 
    'users_id', 'created_at', 'updated_at'];
}
