<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branches extends Model
{
    use HasFactory;


    protected $fillable = [
        'branch_name',
        'branch_location',
        'company_id',
        'latitude',
        'longitude',
    ];

    protected $primaryKey = 'branch_id';
}
