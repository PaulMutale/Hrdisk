<?php

namespace App\Http\Controllers\Employees;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\loans as employee_loans;
use App\{Employee,Admin,CashAdvance,tasks,employee_kyc};
use App\Providers\RouteServiceProvider;

class loans extends Controller
{
    //

    public function kyc_cashadvance_details_view (Request $request){
      $check_kyc = employee_kyc::where('employee_email',"=",Auth::guard('Employees')->user()->email)->latest()->first();
      
        if(empty($check_kyc->borrower_photo_signature)){
            Session::flash('warnings', 'Please Finish Yor KYC Forms First');
            return redirect('/employees_dashboard');//->route($this->folder.'dashboard');
              
        } 
      
      
     $check_payroll = Employee::where('email',"=",Auth::guard('Employees')->user()->email)->first();
      
      if(($check_payroll->status==0)){
            Session::flash('warnings', 'Please apply to be added on the payroll first');
            return redirect('/employees_dashboard');//->route($this->folder.'dashboard');      
        }          
      
      
      
             
        if(($check_payroll->status==2)){
            Session::flash('warnings', 'Please wait for payroll application approval first');
            return redirect('/employees_dashboard');//->route($this->folder.'dashboard');
           
        }
      
      
      
      
      
      
      
      
      
      
      
        
        return view('employees/cashadvance/loans');
}
    

    public function kyc_cashadvance_details_submit (Request $request){


        
        $validate = Validator::make($request->all(), [
            'title' => 'required|string',
            'date' => 'required',
			'employee_loan_amount' => 'required|numeric',
            'employee_total_repayment' => 'required|numeric',
            'employee_duration' => 'required|numeric',
			'employee_monthly' => 'required|numeric',
            
			
		]);
        /*
		[
			'employee_email.unique' => "The Email address has already been registered.",
            'employee_number.unique' => "The Email address has already been registered.",
			'employee_name.required' => "The Company name is required.",
			'employee_email.required' => 'The Email is required.',
			'employee_email.email' => 'Please enter  a valid email.',
		]);
        */
		
		if($validate->fails() ){
			return Redirect()->back()->with([
								'status'=>false,
								'errors'=>$validate->errors()
							]);
		}


        // Check for any pending Loan or Active Loan 
        $employee_status = Employee::where('email',"=",Auth::guard('Employees')->user()->email)->first(); 
        $employee_id = $employee_status->id;
        $company_number = $employee_status->security_number;
        $loan_status = CashAdvance::where('employee_id',"=",$employee_id)->where('loan_status',"=",2)->exists(); 
        if($loan_status){
    Session::flash('warnings', 'You have a pending loan!');
    return redirect('/employees_dashboard');//->route($this->folder.'dashboard');
            
        }


        // Check for any Active Loan

    $loan_status_active = CashAdvance::where('employee_id',"=",$employee_id)->where('loan_status',"=",1)->exists(); 
    if($loan_status_active){
    Session::flash('warnings', 'You have an active loan! Wait for this loan to be settled and try again');
    return redirect('/employees_dashboard');//->route($this->folder.'dashboard');
            
        }

        
             CashAdvance::create([
            'employee_id' => $employee_id,
            'rate_amount' => $request->employee_loan_amount,            
            'employee_total_repayment' => 0,
            'duration' => $request->employee_duration,
            'emi' => $request->employee_monthly,
            'loan_status' => 2,
            'title' => $request->title,
            'date' => $request->date,
            'security_number' => $company_number,
       ]);

       
     
  /*    

$employee = Employee::where('email',"=",Auth::guard('Employees')->user()->email)->firstOrFail();
$security_number = $employee->security_number;
$employer = Admin::where('security_number',"=",$security_number)->firstOrFail();
$hr_number = $employer->phone; 
$company_name = $employer->username;

$employee_name = $employee->first_name .' '.$employee->last_name; 

       // Nortify HR via SMS
       $cat_time = Carbon::now()->addHours(6); 
    $scheduled_time = date('Y-m-d H:i', strtotime($cat_time->addMinutes(1)));
   
    
   $response = Http::withToken('31|szgQcHtLxIN64qKhroXKTQzkPEjkRmrdqvGFZT6d')->post('https://gateway.excitesms.tech/api/v3/sms/send', [
        "sender_id" => "ELIANACASHX",
        "type" => "plain",
        "schedule_time" => "$scheduled_time",
        "message" => "Hi $company_name, kindly check loan application from $employee_name one of your employees.",
        "recipient" => "26$hr_number"
        
    ]); 
       
       */
    Session::flash('success', 'Your loan has been submitted successfully, wait for SMS confirmation once approved!');
    return redirect('/employees_dashboard');//->route($this->folder.'dashboard');
   
    }


    

    
}
