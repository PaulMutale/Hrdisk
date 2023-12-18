<?php

namespace App\Http\Controllers\Employees;
use App\Notifications\payslipAttachment;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\PDFController;
use mikehaertl\pdftk\Pdf;
use App\{Employee,employee_kyc};
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Session;

class downloadPayslips extends Controller
{
    public function payslip_details_view(){
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
        
      
      
      
      
      
       return view('employees/payslips/download');
      }




    //
    public function payslip_details_submit(Request $request){
        
        $employee = Employee::where('email', "=", Auth::guard('Employees')->user()->email)->firstOrFail();
        $employee_id = $employee->employee_id;
        $monthYear =$request->month."-".$request->year;
        $company = Auth::guard('Employees')->user()->security_number; 
        $fileToDownload = "PAYSLIPS/$company/$monthYear/".$employee_id.'.pdf';       
        if (file_exists($fileToDownload) && $request->share_to_my_email == Auth::guard('Employees')->user()->email) {
            
    $file_path = public_path("PAYSLIPS/$company/$monthYear/".$employee_id.'.pdf');

    $employee->notify(new payslipAttachment($file_path));
    Session::flash('success', 'Payslip Sent via email successfully !');
    return redirect('/employees_dashboard');
   // return response()->download($fileToDownload);


        //  Storage::download($fileToDownload);
        } 

        if (file_exists($fileToDownload)) {
             
          $file_path = public_path("PAYSLIPS/$company/$monthYear/".$employee_id.'.pdf');
            $employee->notify(new payslipAttachment($file_path));
             Alert::toast('Payslip Downloaded Successfully', 'success');
             return response()->download($fileToDownload);
        
        
                //  Storage::download($fileToDownload);
                } 
    else{
        Session::flash('warnings', 'No Payslip found for the Month and Year Selected!');
        return redirect('/employees_dashboard');
    }
   
     
       
   
}
}
