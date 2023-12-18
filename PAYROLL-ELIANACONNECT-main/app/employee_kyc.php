<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class employee_kyc extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_name',
        'employee_email',
        'employee_address',      
        'nok',
        'name_of_nok',
        'phone_of_nok',      
        'employee_gender',
        'employee_photo',
        'employee_bank_name',
        'employee_bank_branch',
        'employee_bank_account_number' ,
        'employee_bank_account_type',
        'employee_mobile_money_number' ,
        'employee_mobile_money_name',
    ];

    
}
