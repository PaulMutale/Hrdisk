<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tax extends Model
{
    use HasFactory;
    protected $fillable = [
        'fb',
        'fbp',
        'sb',
        'sbp',
        'tb',
        'tbp',
        'fob',
        'fobp',
        'security_number'
    ];
}
