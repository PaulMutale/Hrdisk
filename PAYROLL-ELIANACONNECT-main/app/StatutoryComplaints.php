<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatutoryComplaints extends Model
{
    use HasFactory;

    protected $fillable = [
        'reasons',
        'security_number'
    ];
}
