<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PayrollRecords extends Model
{
    use HasFactory;


    protected $fillable = [
        'tpin',
        'net',
        'phone',
        'napsa',
        'nhima',
        'payee',
        'security_number',
        'employee_name',
        'employee_id',
        'monthYear'
    ];


    protected $dates = [
        'created_at',
        'updated_at',
    ];


}
