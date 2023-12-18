<?php

namespace App\Http\Controllers\Employees;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\{Employee,Admin,employee_kyc};
use Carbon\Carbon;

class payroll extends Controller
{
    //
    public function payroll_details_view(){
      
       $check_kyc = employee_kyc::where('employee_email',"=",Auth::guard('Employees')->user()->email)->latest()->first();
      
        if(empty($check_kyc->borrower_photo_signature)){
            Session::flash('warnings', 'Please Finish Yor KYC Forms First');
            return redirect('/employees_dashboard');//->route($this->folder.'dashboard');
              
        } 
      
      
      
        
      $check_payroll = Employee::where('email',"=",Auth::guard('Employees')->user()->email)->first();
       
        if(($check_payroll->status==2)){
            Session::flash('warnings', 'You have already applied to be added on the payroll');
            return redirect('/employees_dashboard');//->route($this->folder.'dashboard');
           
        }
      
      
  if(($check_payroll->is_active==1)){
            Session::flash('warnings', 'You are already on payroll');
            return redirect('/employees_dashboard');//->route($this->folder.'dashboard');
           
        }     
      
      
      
      
       
        $employee_details = Employee::where('email',"=",Auth::guard('Employees')->user()->email)->firstOrFail(); 
        return view('employees/payroll/apply_to_be_added',compact('employee_details'));
    }

    public function payroll_details_submit(Request $request){
        $validate = Validator::make($request->all(), [
			'first_name' => 'required|string',
            'last_name' => 'required|string',
            'phone' => 'required',
            'email' => 'required|email',
            'birthdate' => 'required',
			'address' => 'required|string',
            'gender' => 'required|string',
            'remark' => 'nullable|string',
            'security_number' => 'required|string',
            'nrc' => 'required|mimes:pdf|max:2048',
			
		]);
       
		if($validate->fails() ){
			return Redirect('/employees_dashboard')->with([
								'status'=>false,
								'errors'=>$validate->errors()
							]);
		}



      
        // Copy to Employees table
       $kyc = Employee::where('email',"=",Auth::guard('Employees')->user()->email)->firstOrFail(); 
           
        $kyc->status = 2;
        $kyc->save();
        

/*    

$employee = Employee::where('email',"=",Auth::guard('Employees')->user()->email)->firstOrFail();
$security_number = $employee->security_number;
$employer = Admin::where('security_number',"=",$security_number)->firstOrFail();
$hr_number = $employer->phone; 
$employee_number = str_replace('-','',$employee->phone); 
$company_name = $employer->username;

$employee_name = $employee->first_name .' '.$employee->last_name; 
$company_name = $employer->username;


       // Nortify HR via SMS
 $cat_time = Carbon::now(); 
 $scheduled_time = date('Y-m-d H:i', strtotime($cat_time->addMinutes(1)));
   
    
   $response = Http::withToken('31|szgQcHtLxIN64qKhroXKTQzkPEjkRmrdqvGFZT6d')->post('https://gateway.excitesms.tech/api/v3/sms/send', [
        "sender_id" => "ELIANACASHX",
        "type" => "plain",
        "schedule_time" => "$scheduled_time",
        "message" => "Hi $company_name, $employee_name, your employees sent an application to be added on the payroll.",
        "recipient" => "26$hr_number"
       //There is a pending addition to your employee master file 
    ]); 


// Nortify Employee via SMS
$cat_time = Carbon::now(); 
$scheduled_time = date('Y-m-d H:i', strtotime($cat_time->addMinutes(1)));
  
   
  $response = Http::withToken('31|szgQcHtLxIN64qKhroXKTQzkPEjkRmrdqvGFZT6d')->post('https://gateway.excitesms.tech/api/v3/sms/send', [
       "sender_id" => "ELIANACASHX",
       "type" => "plain",
       "schedule_time" => "$scheduled_time",
       "message" => "Hi $employee_name, your request to be added on the payroll at $company_name has been sent successfully!.",
       "recipient" => "26$employee_number"
       
   ]); 


*/



    Session::flash('success', 'Your Payroll Application has ben submitted succesfully');
    return redirect('/employees_dashboard'); 


    }
}
