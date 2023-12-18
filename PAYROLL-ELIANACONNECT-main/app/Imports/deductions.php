<?php

namespace App\Imports;

use App\Deduction;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
class deductions implements ToModel, WithHeadingRow, WithValidation
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $TPSPs = Deduction::where('security_number',"=",$row['company_id'])->where('deduction_code',"=",$row['deduction_code'])->first();
        
        if($TPSPs){
        $TPSPs->update([
            "security_number" => $row['company_id'],
            "deduction_code" => $row['deduction_code'],           
            "name" => $row['deduction_name'],
            "description" => $row['description']
        ]);
        }
        else{
        
             Deduction::create([
            "security_number" => $row['company_id'],
            "deduction_code" => $row['deduction_code'],           
            "name" => $row['deduction_name'],
            "description" => $row['description']

        ]);
        }
       
        
      
    }
  
  
  public function rules(): array
    {
        return [
            'company_id' => 'required|exists:admins,security_number',
            "deduction_code" => 'required|numeric',
            "deduction_name" => 'required|string',
            "description" => 'nullable|string',
                      
        ];
    }    
  
  
    
}
