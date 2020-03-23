<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    protected $table = 'pago';

    protected $fillable = ['fecha','abono', 
    'nrecibo', 'contrato_id',
    'users_id', 'created_at', 'updated_at'];
}
