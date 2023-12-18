<?php

namespace App;

use App\Http\Controllers\Auth\selfAddEmployee\selfAddEmloyee;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class loans extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'employee_loan_amount',
        'employee_total_repayment',
        'employee_duration',
        'employee_monthly',
        'status',
    ];

    public function selfAddEmployee()
    {
    return $this->belongsTo(selfAddEmployee::class,'employee_id','id');
    }
}
