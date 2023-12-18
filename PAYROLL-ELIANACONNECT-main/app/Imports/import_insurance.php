<?php

namespace App\Imports;

use App\{Insurance,Admin};
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use RealRashid\SweetAlert\Facades\Alert;
use Auth;

class import_insurance implements ToModel, WithHeadingRow, WithValidation
{
    /**
    * @param Collection $collection
    */
    public function model(array $row)
    {
     $Insurance = Insurance::where('security_number',"=",$row['company_id'])->first();
     if($Insurance){
     $Insurance->update([
            "insurance" => strtoupper($row['insurance']), //Insurance percentage
            "insurance_name" => strtoupper($row['policy_name']), //Insurance Name
            "applied_on" => strtoupper($row['applied_on']), 
            "security_number" => $row['company_id'],   
     ]);
     }
     else{
     
     
        Insurance::create([
        "insurance" => strtoupper($row['insurance']), //Insurance percentage
        "insurance_name" => strtoupper($row['policy_name']), //Insurance Name 
        "applied_on" => strtoupper($row['applied_on']), 
        "security_number" => $row['company_id'],   
     
     ]);
    $status = Admin::where('security_number',"=",Auth::user()->security_number)->first();
    $status->update([
    'insurance_done' => 1
    ]); 
       
    }
          
    }
    
    
 public function rules(): array
    {
        return [
           'company_id' => 'required|exists:admins,security_number',
            "policy_name" => 'required',
            "insurance" => 'required',
            "applied_on" => 'required'
           
            
           
        ];
    } 
  
  
  
      
}
