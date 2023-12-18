<?php

namespace App\Imports;

use App\{Position,Allowance};
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
 use Illuminate\Support\Facades\Validator;



class ImportUser implements ToModel, WithHeadingRow, WithValidation
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
      
     return ([new Position([
            "title" => $row['title'],
            "security_number" => $row['security_number'],
             "salary_scale" => $row['salary_scale'],
            "vacancies" => $row['vacancies'],
            "head_count" => $row['head_count']           
        ]),
        new Allowance([
            "name" => $row['allowance_name'], 
            "amount" => $row['allowance_amount'], 
            "security_number" => $row['security_number']   
        ])
    ]);
    }
    
   
    

    
       
    
}
