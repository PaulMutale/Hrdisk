<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Insurance extends Model
{
    use HasFactory;


    protected $fillable = [
        'insurance',
        'insurance_name',
        'applied_on',
        'security_number'
    ];
    
}
