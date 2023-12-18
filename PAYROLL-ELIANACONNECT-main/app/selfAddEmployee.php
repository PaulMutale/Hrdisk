<?php

namespace App;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class selfAddEmployee extends Authenticatable //implements MustVerifyEmail
{
    use HasFactory;
    protected $fillable = [
        'employee_email',
        'employee_number',
        'employee_name',
        'password',
       ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function loans()
    {
    return $this->hasMany(loans::class,'employee_id','id');
    }

    public function leave_days()
    {
    return $this->hasMany(leave_days::class,'employee_id','id');
    }
}
