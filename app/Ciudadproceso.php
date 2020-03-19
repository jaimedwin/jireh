<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ciudadproceso extends Model
{
    protected $table = 'ciudadproceso';

    protected $fillable = ['nombre', 'users_id', 
    'created_at', 'updated_at'];
}
