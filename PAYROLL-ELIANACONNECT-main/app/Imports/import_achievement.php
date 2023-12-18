<?php

namespace App\Imports;

use App\Achievements;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use RealRashid\SweetAlert\Facades\Alert;

class import_achievement implements ToModel, WithHeadingRow, WithValidation
{
    /**
    * @param Collection $collection
    */
    public function model(array $row)
    {
    $date = str_replace('/','-',$row['date']);
     $Achievements = Achievements::where('employee_number',"=",$row['employee_number'])->where('to_added_on',"=",date('Y-m-d',strtotime($date)))->where('security_number',"=",$row['company_id'])->first();
     if($Achievements){
        
     $Achievements->update([
            "bonus_percentage" => strtoupper($row['bonus_percentage']), // pension percentage
            "bonus_name" => strtoupper($row['bonus_name']), // pension name
            "applied_on" => strtoupper($row['applied_on']), 
            "to_added_on" => date('Y-m-d',strtotime($date)), 
            "employee_number" => strtoupper($row['employee_number']), 
            "security_number" => $row['company_id'],   
     ]);
     }
     else{
     
        $date = str_replace('/','-',$row['date']); 
        Achievements::create([
            "bonus_percentage" => strtoupper($row['bonus_percentage']), // pension percentage
            "bonus_name" => strtoupper($row['bonus_name']), // pension name
            "applied_on" => strtoupper($row['applied_on']), 
            "to_added_on" => date('Y-m-d',strtotime($date)),  
            "employee_number" => strtoupper($row['employee_number']), 
            "security_number" => $row['company_id'],   
     ]);
     
       
    }
          
    }
    
    
 public function rules(): array
    {
        return [
           'company_id' => 'required|exists:admins,security_number',
            "bonus_percentage" => 'required',
            "bonus_name" => 'required',
            "applied_on" => 'required',
            "date" => 'required',
            "employee_number" => 'required'
           
            
           
        ];
    } 
  
  
  
      
}
