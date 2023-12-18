<?php

namespace App\Http\Controllers\Employees;

use App\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\{Attendance,Employee};
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Carbon\Carbon;



class OnlineSignInSignOut extends Controller
{

    public function qr_attendance_view()
    {
        
       return view('qrcode.index');
    }


    public function attendance(Request $request)
    {
        
        $validate = Validator::make($request->all(), [
			'email' => 'required|exists:employees'
			
		],
		[
			'email.exists' => "Email does not exist.",
			'email.required' => 'The Email is required.',
			'email.email' => 'Please enter valid email.',
		]);
		
		if($validate->fails()){
			return Redirect()->back()->with([
								'status'=>false,
								'errors'=>$validate->errors()
							]);
		}

       
       $time_in = gmdate('H:i:s', strtotime('+ 2 hours'));
       $time_out =gmdate('H:i:s', strtotime('+ 2 hours'));
       $date = date('Y-m-d');
 
 //
 $email = $request->email;
       
// Company ID 
$company_id = Employee::where('email',"=",$email)->first()->security_number;

// Employee ID number
$id =  Employee::where('email',"=",$email)->first()->id;  


  //Configured Check In Time
        
        $standard_time_in_configured = Employee::where('email',"=",$email)->first()->schedule;
        $normal_log_in_time = Carbon::createFromTimeString($standard_time_in_configured->time_in);

//Configured Check Out Time
        $standard_time_out_configured = Employee::where('email',"=",$email)->first()->schedule;
        $normal_log_out_time = Carbon::createFromTimeString($standard_time_in_configured->time_out);


// Check if the employee is on time
        if (Carbon::createFromTimeString($time_in)->lte($normal_log_in_time)) {
            $ontime_status = 1;
        } else {
            $ontime_status = 0;
        }

        //if User has not Checked In
        $check_login = Attendance::whereDate('date', "=", $date)
        ->where('security_number', "=", $company_id)
        ->where('employee_id', "=", $id)->first();

        //if User has not Checked Out
        $check_out = Attendance::whereDate('date', "=", $date)
        ->where('security_number', "=", $company_id)
        ->where('employee_id', "=", $id)->first();

     
        if(empty($check_login->time_in ?? '')) {
            Attendance::create([
                'date' => $date,
                'time_in' => Carbon::createFromTimeString($time_in)->lte($normal_log_in_time) ? $standard_time_in_configured->time_in : $time_in,
                'security_number' => $company_id,
                'employee_id' => $id,
                'ontime_status' => $ontime_status
                ]);
               
                Alert::success('CHECKED-IN', 'You have checked in Successfully at '.$time_in .'on '.$date); 
                return redirect()->back();


        }
elseif (empty($check_out->time_out  ?? '' )) {
            $check_out = Attendance::whereDate('date', "=", $date)->where('security_number', "=", $company_id)
            ->where('employee_id', "=", $id)->latest()->first();
            $check_out->date = $date;
            $check_out->time_out = Carbon::createFromTimeString($time_out)->gte($normal_log_out_time) ? $standard_time_out_configured->time_out : $time_out;
            $check_out->security_number = $company_id;
            $check_out->employee_id = $id;
            $check_out->save();
            Alert::success('CHECKED-OUT', 'You have checked out Successfully at '.$time_in .'on '.$date); 
            return redirect()->back();
          

        }

        elseif ($check_login) {
            Alert::error('ALREADY CHECKED IN', 'You have already checked in for today'); 
            return redirect()->back();
        }
        else {
            Alert::error('ALREADY CHECKED OUT', 'You have already checked out for today'); 
            return redirect()->back();
        }
    }
}