<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fondodepension extends Model
{
    protected $table = 'fondodepension';

    protected $fillable = ['abreviatura','descripcion', 'users_id', 
    'created_at', 'updated_at']; 
}
