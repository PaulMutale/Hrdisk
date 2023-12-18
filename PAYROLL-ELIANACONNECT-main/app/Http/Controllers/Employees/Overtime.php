<?php

namespace App\Http\Controllers\Employees;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Overtime as Employee_Overtime; 
use Illuminate\Http\Request;
use App\{Employee,employee_kyc};


class Overtime extends Controller
{
    //
    public function overtime_details_view(){
      // Check KYC
      $check_kyc = employee_kyc::where('employee_email',"=",Auth::guard('Employees')->user()->email)->latest()->first();
      
        if(empty($check_kyc->borrower_photo_signature)){
            Session::flash('warnings', 'Please Finish Yor KYC Forms First');
            return redirect('/employees_dashboard');//->route($this->folder.'dashboard');
              
        } 
      
      
      
      // Check Payroll Status
     $check_payroll = Employee::where('email',"=",Auth::guard('Employees')->user()->email)->first();
       
        if(($check_payroll->status==0)){
            Session::flash('warnings', 'Please apply to be added on the payroll first');
            return redirect('/employees_dashboard');//->route($this->folder.'dashboard');      
        }          
      
      
      
             
        if(($check_payroll->status==2)){
            Session::flash('warnings', 'Please wait for payroll application approval first');
            return redirect('/employees_dashboard');//->route($this->folder.'dashboard');
           
        }
       
      
      
      
      
      
      
      
      
      
        return view("employees/overtime/create");
    }


    public function overtime_details_submit(Request $request){
        
       $overtime = Employee::where('email',"=",Auth::guard('Employees')->user()->email)->first(); 
       $employee_number = $overtime->id;
       $company_number = $overtime->security_number;
       $data = [
            'title' => $request->title,
            'description' => $request->description,
            'rate_amount' => $request->rate_amount,
            'hour' => $request->hour,
            'date' => $request->date,
            'employee_id' => $employee_number,
            'security_number' => $company_number,
            'status' => 2
        ];
        Employee_Overtime::create($data);
        Session::flash('success', 'Your Overtime application has been submitted succesfully!');
        return redirect('/employees_dashboard');//->route($this->folder.'dashboard');

       
    }
}
