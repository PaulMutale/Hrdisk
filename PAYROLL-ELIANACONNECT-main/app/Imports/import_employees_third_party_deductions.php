<?php

namespace App\Imports;

use App\ThirdPartyDeductions;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
class import_employees_third_party_deductions implements ToModel, WithHeadingRow, WithValidation
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
      $date = str_replace('/','-',$row['date']);
        return ([new ThirdPartyDeductions([
            "amount" => $row['amount'],
            "security_number" => $row['company_id'],
            "employee_id" => $row['employee_id'],
            "deduction_code" => $row['deduction_code'],
            "deduction_name" => $row['deduction_name'],
            "date" => date('Y-m-d',strtotime($date)),
            "employee_name" => $row['employee_name'],
           

        ]),
       
    ]);
    }
  
  
  public function rules(): array
    {
        return [
                  
            "amount" => 'required|numeric',
            "company_id" => 'required|exists:admins,security_number',
            "employee_id" => 'required|exists:employees,employee_id',
            "deduction_code" =>'required',
            "deduction_name" => 'required',
            "date" => 'required',
            "employee_name" => 'required',
                      
        ];
    }    
}
