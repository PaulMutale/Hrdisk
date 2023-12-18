<?php

namespace App;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;
	protected $guard = 'admin';
	
    protected $fillable = [
        'email',
        'username',
        'image',
        'password',
        'email_verified_at',
        'payments_made_at',
        'company_logo',
        'company_address',
        'airtel_bulk_payments_ic_number',
        'phone',
        'principle_name',
        'principle_email',
        'principle_city',
        'principle_province',
        'company_bank_name',
        'company_bank_branch',
        'bank_account_name',
        'bank_account_type',
        'principle_nrc',
        'company_pacra',
        'principle_passport_photo',
        'kyc_status',
        'principle_signature',
        'latitude',
        'longitude',
        'company_country',
        'tax_done',        
        'pension_done',
        'insurance_done',
        'company_tpin',
        'pricing_plan'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

     /**
    * The attributes that should be mutated to dates.
    *
    * @var array
    */
    protected $dates = ['deleted_at'];
}
