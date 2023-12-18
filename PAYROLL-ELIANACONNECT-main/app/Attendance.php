<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $fillable = [
        'employee_id',
        'date',
        'time_in',
        'time_out',
        'hours_worked',
        'ontime_status',
        'security_number',
        'status'
    ];
    
    protected $dates = [
        'created_at',
        'updated_at',
        'date',
    ];

   
  public function getDateAttribute(){
        return date("M d, Y",strtotime($this->attributes['date']));
    }

    public function setDateAttribute($value){
        $this->attributes['date'] = date("Y-m-d",strtotime($value));
    }

  
  
  
  

    public function employee(){
        return $this->hasOne(Employee::class,'id','employee_id');
    }
}