<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApiLog extends Model
{
   protected $fillable = [
        'method',
        'url',
        'x_owner',
        'ip',
    ];
}