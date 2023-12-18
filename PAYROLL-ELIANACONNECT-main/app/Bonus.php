<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bonus extends Model
{
    use HasFactory;

    protected $fillable = [
        'bonus_percentage',
        'bonus_name',
        'applied_on',
        'to_added_on',
        'security_number'

    ];
}
