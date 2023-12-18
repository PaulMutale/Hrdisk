<?php

namespace App\Http\Controllers\Employees;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;
use App\{Employee,leave_days,Admin,employee_kyc};
use App\selfAddEmployee;
use Illuminate\Http\Request;
use Carbon\Carbon;

class leave extends Controller
{
    
public function leave_details_view(){
  
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
  

  
  
$employee_status = Employee::where('email',"=",Auth::guard('Employees')->user()->email)->first();        
$leave_days = leave_days::where('employee_id',"=",$employee_status->id)->latest()->first();
$start_time = Carbon::parse($employee_status->employee_start_date);
$current_time = Carbon::parse(Carbon::now());
$months = $start_time->diffInMonths($current_time, false);

// Check for any pending or active leave
  
  
$leave_stat = leave_days::where('employee_id',"=",$employee_status->id)->where('status',"=",2)->orWhere('status',"=",1)->exists();  
  
 if($leave_stat){
    Session::flash('warnings', 'You have either a pending or an active leave. Application denied!');
    return redirect('/employees_dashboard');
 }


if(is_null($leave_days)){
    $exhausted_leaves = 0;
    $accrued_leaves = round($months * 2);
    $remaining_leaves = $accrued_leaves;
    $registered_on = $employee_status->employee_start_date;
    return view('employees/leave/applyForLeave',compact('accrued_leaves','exhausted_leaves','remaining_leaves','registered_on','months'));

}
else{
    // Accrued Leaves will always be inserted and not retrieved 
   $accrued_leaves = round($months * 2);
   $exhausted_leaves = $leave_days->exhausted_leaves;
   $remaining_leaves = $accrued_leaves - $exhausted_leaves;
   $registered_on = $employee_status->employee_start_date;
   return view('employees/leave/applyForLeave',compact('accrued_leaves','exhausted_leaves','remaining_leaves','registered_on','months'));
}
    }


    public function leave_details_submit(Request $request){

        $validate = Validator::make($request->all(), [
           	'leave_name' => 'required|string',
            'exhausted_leaves' => 'required|numeric',
            'remaining_leaves' => 'required|numeric',
            'leave_start_date' => 'nullable|date',
            'leave_end_date' => 'nullable|date',
            'commuted_days' => 'nullable|numeric',
           
			
		]);
       
		if($validate->fails() ){
			return Redirect()->back()->with([
								'status'=>false,
								'errors'=>$validate->errors()
							]);
		}


// Leave Data Starts here 
$employee_status = Employee::where('email',"=",Auth::guard('Employees')->user()->email)->first();        
$start_time = Carbon::parse($employee_status->employee_start_date);
$current_time = Carbon::parse(Carbon::now());
$months = $start_time->diffInMonths($current_time, false);

//Leave Data Ends here



//Leave Duration starts here 

$leave_start_date = is_null($request->leave_start_date) ? 'N/A' : $request->leave_start_date;
$leave_end_date = is_null($request->leave_end_date) ? 'N/A' : $request->leave_end_date;

if($leave_start_date != 'N/A'  && $leave_end_date != 'N/A'){
  $start_date = $leave_start_date;
  $end_date = $leave_end_date; 
  $duration = Carbon::parse($start_date)->diffInDays($end_date, false); 
  
}


if($leave_start_date == 'N/A'  && $leave_end_date == 'N/A'){
    $start_date = $leave_start_date;
    $end_date = $leave_end_date; 
    $duration = 0; 
    
  }

// Leave Duration ends here 



// Commutation Leave Starts Here
$commutation = is_null($request->commuted_days) ? 0 : $request->commuted_days;

$leave_balance_funds = (($employee_status->salary * $commutation) / 26);
//End Commutation Leave Here 






//Leave armotization starts here
$accrued_leaves = $request->accrued_leaves;
$exhausted_leaves = $request->exhausted_leaves + $duration + $commutation; 
// Remaing Leaves will always be inserted
$remaining_leaves = $accrued_leaves - $exhausted_leaves;
// Leave Armotization ends here




if ($remaining_leaves > 0) {
    leave_days::create([
        "employee_id" => $employee_status->id,
        "leave_name" => $request->leave_name,
        "accrued_leaves" => $accrued_leaves,
        "exhausted_leaves" => $exhausted_leaves,
        "remaining_leaves" => $remaining_leaves,
        "leave_start_date" => $start_date,
        "leave_end_date" => $end_date,
        "duration" => $duration,
        "commutation_balance" => $leave_balance_funds,
        "security_number" => $employee_status->security_number,
        "is_commuted" => 0,
        "status" => 2
        
   ]);
   Session::flash('success', 'Your Leave Application has been submitted successfully, wait for approval status on your dashboard!');
    return redirect('/employees_dashboard');//->route($this->folder.'dashboard');
}

 else{
    Session::flash('warnings', 'Whooops you have exhausted your leave days');
    return redirect('/employees_dashboard');//->route($this->folder.'dashboard');
     
 }      


    }
}
