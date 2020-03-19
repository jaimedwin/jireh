<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Corporacion extends Model
{
    protected $table = 'corporacion';

    protected $fillable = ['nombre','correonotificacion', 'users_id', 
    'created_at', 'updated_at'];
}
