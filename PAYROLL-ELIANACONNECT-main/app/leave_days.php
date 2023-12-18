<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class leave_days extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'leave_name',
        'exhausted_leaves',
        'remaining_leaves',
        'status',
        'security_number',
        'leave_start_date',
        'leave_end_date',
        'is_commuted',
        'commutation_balance',
        'accrued_leaves',
         'duration'
    ];

    public function Employee()
    {
    return $this->belongsTo(Employee::class,'employee_id','id');
    }
    
    
   public function getCreatedAtAttribute(){
        return date("M d, Y",strtotime($this->attributes['created_at']));
    } 
    
    
}