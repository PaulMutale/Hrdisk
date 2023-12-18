<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThirdPartyDeductions extends Model
{
    use HasFactory;
    protected $fillable = [
        'amount',
        'security_number',
        'employee_id',
        'deduction_code',
        'deduction_name',
        'date',
        'employee_name'
       ];

    
    
  public function getDateAttribute(){
        return date("M d, Y",strtotime($this->attributes['date']));
    }  
    
    
    
}
