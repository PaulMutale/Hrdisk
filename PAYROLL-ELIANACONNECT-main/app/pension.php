<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pension extends Model
{
    use HasFactory;

    protected $fillable = [
        'pension',
        'pension_name',
        'applied_on',
        'security_number'
    ];

}
