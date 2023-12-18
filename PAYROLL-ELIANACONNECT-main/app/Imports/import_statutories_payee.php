<?php

namespace App\Imports;

use App\{Tax,Admin};
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use RealRashid\SweetAlert\Facades\Alert;
use Auth;

class import_statutories_payee implements ToModel, WithHeadingRow, WithValidation
{
    /**
    * @param Collection $collection
    */
    public function model(array $row)
    {
     $statutories = Tax::where('security_number',"=",$row['company_id'])->first();
     if($statutories){
     $statutories->update([
            "fb" => ($row['first_band']), // first band
            "fbp" => ($row['first_band_percentage']), // first band percentage 
            "sb" => ($row['second_band']), // second band
            "sbp" => ($row['second_band_percentage']), // second band percentage
            "tb" => ($row['third_band']), // third band 
            "tbp" => ($row['third_band_percentage']), // third band percentage 
            "fob" => ($row['fourth_band']), // fourth band  
            "fobp" => ($row['fourth_band_percentage']), // fourth band percentage 
            "security_number" => ($row['company_id']), // Security Number
            
     ]);
     }
     else{
     
     
     Tax::create([
            "fb" => ($row['first_band']), // first band
            "fbp" => ($row['first_band_percentage']), // first band percentage 
            "sb" => ($row['second_band']), // second band
            "sbp" => ($row['second_band_percentage']), // second band percentage
            "tb" => ($row['third_band']), // third band 
            "tbp" => ($row['third_band_percentage']), // third band percentage 
            "fob" => ($row['fourth_band']), // fourth band  
            "fobp" => ($row['fourth_band_percentage']), // fourth band percentage 
            "security_number" => ($row['company_id']), // Security Number
         
     
     ]);
    
    $status = Admin::where('security_number',"=",Auth::user()->security_number)->first();
    $status->update([
    'tax_done' => 1
    ]);
    
       
    }
          
    }
    
    
 public function rules(): array
    {
        return [
           'company_id' => 'required|exists:admins,security_number',
           'first_band' => 'required',
           'first_band_percentage' => 'required',
           'second_band' => 'required',
           'second_band_percentage' => 'required',
           'third_band' => 'required',
           'third_band_percentage' => 'required',
           'fourth_band' => 'required',
           'fourth_band_percentage' => 'required',
           
           
            
           
        ];
    } 
  
  
  
      
}
