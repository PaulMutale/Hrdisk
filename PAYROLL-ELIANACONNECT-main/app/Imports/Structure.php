<?php

namespace App\Imports;

use App\Position;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use RealRashid\SweetAlert\Facades\Alert;

class Structure implements ToModel, WithHeadingRow, WithValidation
{
    /**
    * @param Collection $collection
    */
    public function model(array $row)
    {
     $structure = Position::where('title',"=",strtoupper($row['title']))->where('security_number',"=",$row['company_id'])->first();
     if($structure){
     $structure->update([
            "title" => $row['title'],
            "security_number" => $row['company_id'],
            "salary_scale" => $row['salary_scale'],
            "vacancies" => $row['vacancies'],
            "head_count" => $row['head_count'],
            "housing_allowance" => $row['housing_allowance'],
            "transport_allowance" => $row['transport_allowance']     
     ]);
     }
     else{
     
     
     Position::create([
            "title" => $row['title'],
            "security_number" => $row['company_id'],
            "salary_scale" => $row['salary_scale'],
            "vacancies" => $row['vacancies'],
            "head_count" => $row['head_count'],
            "housing_allowance" => $row['housing_allowance'],
            "transport_allowance" => $row['transport_allowance']  
     
     ]);
     
       
    }
          
    }
    
    
 public function rules(): array
    {
        return [
           'company_id' => 'required|exists:admins,security_number',
            "title" => 'required|string',
            "salary_scale" => 'required|numeric',
            "vacancies" => 'required|numeric',
            "head_count" => 'required|numeric',
            "housing_allowance" => 'nullable|numeric',
            "transport_allowance" => 'nullable|numeric'
           
        ];
    } 
  
  
  
      
}
