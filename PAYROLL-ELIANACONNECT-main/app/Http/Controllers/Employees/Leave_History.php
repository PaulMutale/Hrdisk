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

class Leave_History extends Controller
{
    public function leave_history()
    {
        $check_kyc = employee_kyc::where('employee_email', "=", Auth::guard('Employees')->user()->email)->latest()->first();

        if (empty($check_kyc->borrower_photo_signature)) {
            Session::flash('warnings', 'Please Finish Yor KYC Forms First');
            return redirect('/employees_dashboard');//->route($this->folder.'dashboard');
        }



        $check_payroll = Employee::where('email', "=", Auth::guard('Employees')->user()->email)->first();

        if (($check_payroll->status==0)) {
            Session::flash('warnings', 'Please apply to be added on the payroll first');
            return redirect('/employees_dashboard');//->route($this->folder.'dashboard');
        }




        if (($check_payroll->status==2)) {
            Session::flash('warnings', 'Please wait for payroll application approval first');
            return redirect('/employees_dashboard');//->route($this->folder.'dashboard');
        }




        $leaves = $check_payroll->leave_days;

        return view('employees/leave_history/leave_history', compact('leaves'));
    }
}
