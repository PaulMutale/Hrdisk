<?php

namespace App\Imports;

use App\pension as Pension;
use App\Admin;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use RealRashid\SweetAlert\Facades\Alert;
use Auth;

class import_pension implements ToModel, WithHeadingRow, WithValidation
{
    /**
    * @param Collection $collection
    */
    public function model(array $row)
    {
     $Pension = Pension::where('security_number',"=",$row['company_id'])->first();
     if($Pension){
     $Pension->update([
            "pension" => strtoupper($row['pension']), // pension percentage
            "pension_name" => strtoupper($row['pension_name']), // pension name
            "applied_on" => strtoupper($row['applied_on']), 
            "security_number" => $row['company_id'],   
     ]);
     }
     else{
     
     
        Pension::create([
            "pension" => strtoupper($row['pension']), // pension percentage
            "pension_name" => strtoupper($row['pension_name']), // pension name
            "applied_on" => strtoupper($row['applied_on']), 
            "security_number" => $row['company_id'],     
     
     ]);
     
     $status = Admin::where('security_number',"=",Auth::user()->security_number)->first();
     $status->update([
     'pension_done' => 1
    ]);
       
    }
          
    }
    
    
 public function rules(): array
    {
        return [
           'company_id' => 'required|exists:admins,security_number',
            "pension" => 'required',
            "pension_name" => 'required',
            "applied_on" => 'required'
           
            
           
        ];
    } 
  
  
  
      
}
