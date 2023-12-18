<?php

namespace App\Http\Controllers\Admin;

use App\{Achievements, Bonus, Employee,Overtime,Deduction,Attendance,Allowance, CashAdvance, PayrollRecords, Position, ThirdPartyDeductions,Tax};
use Illuminate\Support\Facades\Session;
use Intervention\Image\Exception\NotFoundException;
use App\Jobs\storePayslips;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use ZipArchive;
use DataTables;
use File;
use PDF;
use Auth;

class PayrollController extends Controller
{
    // Check if the principle has completed the KYC
    public function __construct()
    {
        $this->middleware('hasKYCBeenDone?', ['except' => 'admin.KYC.index']);
    }
    private $folder = "admin.payroll.";

    public function index()
    {


        return View($this->folder.'index',[
            'get_data' => route($this->folder.'getData'),
        ]);
    }
    
    public function getData(){
        return View($this->folder.'content',[
            'add_new' => "/",
            'getDataTable' => route($this->folder.'getDataTable'),
            'payroll_url' => route($this->folder."payrollExportPDF"),
            'payslip_url' => route($this->folder."payslipExportPDF"),
        ]);
    }

    public function getDataTable(Request $request){
       // $deduction_amount = Deduction::where('security_number',"=",Auth::user()->security_number)->sum("amount");
    	$payroll = $this->payroll($request);

        return Datatables::of($payroll)
                    ->addIndexColumn()
                    ->addColumn('employee', function($data){
                    	return "<div class='row'><div class='col-md-3 text-center'><img src='".$data->media_url['thumb']."' class='rounded-circle table-user-thumb'></div><div class='col-md-6 col-lg-6 my-auto'><b class='mb-0'>".$data->first_name." ".$data->last_name."</b><p class='mb-2' title='".$data->employee_id."'><small><i class='ik ik-at-sign'></i>".$data->employee_id."</small></p></div><div class='col-md-4 col-lg-4'><small class='text-muted float-right'></small></div></div>";
                    })
                    ->addColumn('basic', function($data){
                        return number_format($data->salary,2);
                    })
                    ->addColumn('tpin', function($data) {
                    	return ($data->tpin);
                    })
                    ->addColumn('cash_advance', function($data){
                    	return number_format($data->cashAdvances->sum('emi'),2);
                    })
                    ->addColumn('overtime', function($data){
                        $amount = 0;
                        foreach($data->overtimes as $ov){
                            $amount += (1.5 * $ov->rate_amount * ($ov->hour/60));
                        } 
                        return number_format($amount,2);
                    })
                    ->addColumn('rate_per_hour', function($data){
                        return number_format($data->rate_per_hour,2);
                    })
                    
                    ->rawColumns(['employee','gross','deduction','cash_advance','net_pay','overtime'])
                    ->toJson();
    }

    public function payrollExportPDF(Request $request){
       // return $id;
       // return \json_encode("Ok Cool"); 
    	//$payrolls = $this->payroll($request);

    	$pdf = PDF::loadView($this->folder."export.toPDF");
    	
    	/*
    	return View($this->folder."export.payroll",[
    		'payrolls'=> $payrolls,
    		'date'=> $request->date,
    		'deduction_amount' => Deduction::sum("amount")
    	]);
    	*/
    	$fileName = "payroll-".date("d-M-Y")."-".time().'.pdf';
    	return $pdf->download($fileName);
    }

 public function payslipExportPDF(Request $request){


$share = $request->share;   
$date = explode(' - ', $request->date);
$end_date = date("Y-m-d",strtotime($date[1])); 

$monthYear = date('F-Y', strtotime($end_date));

/*
  
$check_if_payroll_has_been_run = PayrollRecords::where('security_number',"=", Auth::user()->security_number)->where('monthYear',"=",$monthYear)->exists(); 

if($check_if_payroll_has_been_run){

    return response()->json([
        'status'=>false,
        "message"=>"Whoooops! You have already compiled the PAYROLL For $monthYear"
       
        ]);
  
}

*/
                  
$payslips = $this->payroll($request);
foreach ($payslips as $payslip) {
    set_time_limit(180);
  
   $payee_band  = Tax::where('security_number', "=", Auth::user()->security_number)
         ->first();

         $paye_1st_band = explode('-',$payee_band->fb);
         $paye_1st_lower_band =  filter_var($paye_1st_band[0], FILTER_VALIDATE_FLOAT, FILTER_FLAG_ALLOW_THOUSAND); 
         $paye_1st_higher_band = filter_var($paye_1st_band[1], FILTER_VALIDATE_FLOAT, FILTER_FLAG_ALLOW_THOUSAND);
         
         $paye_2nd_band = explode('-',$payee_band->sb);
         $paye_2nd_lower_band = filter_var($paye_2nd_band[0], FILTER_VALIDATE_FLOAT, FILTER_FLAG_ALLOW_THOUSAND);  
         $paye_2nd_higher_band = filter_var($paye_2nd_band[1], FILTER_VALIDATE_FLOAT, FILTER_FLAG_ALLOW_THOUSAND);

         $paye_3rd_band = explode('-',$payee_band->tb);
         $paye_3rd_lower_band = filter_var($paye_3rd_band[0], FILTER_VALIDATE_FLOAT, FILTER_FLAG_ALLOW_THOUSAND); 
         $paye_3rd_higher_band = filter_var($paye_3rd_band[1], FILTER_VALIDATE_FLOAT, FILTER_FLAG_ALLOW_THOUSAND); 


         $paye_4th_band = explode('-',$payee_band->fob);
         $paye_4th_lower_band = filter_var($paye_4th_band[0], FILTER_VALIDATE_FLOAT, FILTER_FLAG_ALLOW_THOUSAND); 
        






        



         $housing_allowance = Position::where('security_number', "=", Auth::user()->security_number)->where('id', "=", $payslip->position_id)->sum("housing_allowance");
         $transport_allowance = Position::where('security_number', "=", Auth::user()->security_number)->where('id', "=", $payslip->position_id)->sum("transport_allowance");

         $p1 = Tax::where('security_number',"=",Auth::user()->security_number)->first()->fbp;
         $fbp = ($p1/100);
         $p2 = Tax::where('security_number',"=",Auth::user()->security_number)->first()->sbp;
         $sbp = ($p2/100);
         $p3 = Tax::where('security_number',"=",Auth::user()->security_number)->first()->tbp;
         $tbp = ($p3/100);
         $p4 = Tax::where('security_number',"=",Auth::user()->security_number)->first()->fobp;
         $fobp = ($p4/100);


//
         $total_overtime_amount = 0;
         foreach ($payslip->overtimes as $ov) {
             $total_overtime_amount += (1.5 * $ov->rate_amount * ($ov->hour/60));
         }


         $total_standard_deductions = 0;
         
         //$standard_deductions = Deduction::where('security_number',"=",auth()->user()->security_number)->where('employee_id',"=",1)->orWhere('employee_id',"=",$payslip->employee_id)->whereDate('start_date',"=",$end_date)->orWhereDate('end_date',"=",'recurring')->get();   
         $standard_deductions = Deduction::where('security_number', auth()->user()->security_number)
    ->where(function ($query) use ($payslip, $end_date) {
        $query->where('employee_id', 1)
            ->orWhere('employee_id', $payslip->employee_id);
    })
    ->where(function ($query) use ($end_date) {
        $query->whereDate('start_date', $end_date)
            ->orWhere('end_date', 'recurring');
    })
    ->get();

         
         
      //   $total_standard_deductions = Deduction::where('security_number',"=",auth()->user()->security_number)->where('employee_id',"=",1)->orWhere('employee_id',"=",$payslip->employee_id)->whereDate('start_date',"=",$end_date)->orWhereDate('end_date',"=",'recurring')->sum('amount');;
    $total_standard_deductions =  Deduction::where('security_number', auth()->user()->security_number)
    ->where(function ($query) use ($payslip, $end_date) {
        $query->where('employee_id', 1)
            ->orWhere('employee_id', $payslip->employee_id);
    })
    ->where(function ($query) use ($end_date) {
        $query->whereDate('start_date', $end_date)
            ->orWhere('end_date', 'recurring');
    })->sum('amount');    
         




         $pension =\App\pension::where('security_number', "=", Auth::user()->security_number)->first();
         $insurance =\App\Insurance::where('security_number', "=", Auth::user()->security_number)->first();

         $bonus = Bonus::where('security_number', "=", Auth::user()->security_number)->whereDate('to_added_on',"=",$end_date)->first();
         $achievements = Achievements::where('security_number', "=", Auth::user()->security_number)->where('employee_number',"=",$payslip->employee_id)->whereDate('to_added_on',"=",$end_date)->first();
          
  
           $total_hours_worked = 0;
            foreach($payslip->attendances as $hours){
            $total_hours_worked += (empty($hours->hours_worked) ? 0 : $hours->hours_worked);
            }



         

$bonus_amount = 0;
$achievements_amount = 0;
  
$bonus_name = " ";
$achievements_name = " ";  

   if($bonus){
            $bonus_name = $bonus->bonus_name;
            $bonus_applicable_on = $bonus->applied_on;
            $bonus_value = ($bonus->bonus_percentage/100);

            if($bonus_applicable_on === 'BASIC PAY'){
              $bonus_amount = $bonus_value * $payslip->salary;  
            }

           
            
        }


        if($achievements){
            $achievements_name = $achievements->bonus_name;
            $achievements_applicable_on = $achievements->applied_on;
            $achievements_value = ($achievements->bonus_percentage/100);

            if($achievements_applicable_on === 'BASIC PAY'){
                $achievements_amount = $achievements_value * $payslip->salary;  
            }

          
        }
  
  
        if($total_hours_worked < -1000) {
            $basic_pay = ($total_hours_worked * $payslip->rate_per_hour);
            $gross_earnings = $achievements_amount + $bonus_amount + ($payslip->salary) + $housing_allowance + $transport_allowance + $total_overtime_amount;
          }
          
          else{
          
            $gross_earnings = $achievements_amount + $bonus_amount + ($payslip->salary) + $housing_allowance + $transport_allowance + $total_overtime_amount;
          }
          
           
  
        


         if ($gross_earnings >= $paye_1st_lower_band && $gross_earnings <= $paye_1st_higher_band) {
             $payee = (($fbp)*($paye_1st_higher_band - $paye_1st_lower_band));

         } 
         
         elseif ($gross_earnings >= $paye_2nd_lower_band && $gross_earnings <= $paye_2nd_higher_band) {
             $payee = (($fbp)*($paye_1st_higher_band - $paye_1st_lower_band)) + (($gross_earnings - $paye_2nd_lower_band) * ($sbp));
         }
         
         elseif ($gross_earnings >= $paye_3rd_lower_band && $gross_earnings <= $paye_3rd_higher_band) {
             $payee = (($fbp)*($paye_1st_higher_band - $paye_1st_lower_band)) +  (($sbp)*($paye_2nd_higher_band - $paye_2nd_lower_band)) +  (($gross_earnings - $paye_3rd_lower_band) * ($tbp));
         } 
         
         else {
             $payee = (($fbp)*($paye_1st_higher_band - $paye_1st_lower_band)) +  (($sbp)*($paye_2nd_higher_band - $paye_2nd_lower_band)) + (($tbp)*($paye_3rd_higher_band - $paye_3rd_lower_band))  +  (($gross_earnings - $paye_4th_lower_band) * ($fobp)); 
         } 
  
  
  
  
    $pdf = PDF::loadView($this->folder."export.toPDF", [
        'logo' => 'LOGOS_UPLOADS/'.Auth::user()->company_logo,
        'payslip'=> $payslip,
        'date'=> $request->date,
        'deduction_amount'=> ThirdPartyDeductions::where('security_number', "=", Auth::user()->security_number)->where('employee_id',"=",$payslip->employee_id)->whereDate('date',"=",$end_date)->sum("amount"),
        'deductions'=> ThirdPartyDeductions::where('security_number', "=", Auth::user()->security_number)->where('employee_id',"=",$payslip->employee_id)->whereDate('date',"=",$end_date)->get(),
        'salary_advance' => CashAdvance::where('security_number', "=", Auth::user()->security_number)->where('employee_id',"=",$payslip->id)->where('loan_status',"=",1)->first(),
        'monthYear' => date('F-Y', strtotime($end_date)),
        'paye_1st_lower_band' => $paye_1st_lower_band,
        'paye_1st_higher_band' => $paye_1st_higher_band,
        'paye_2nd_lower_band' => $paye_2nd_lower_band,
        'paye_2nd_higher_band' => $paye_2nd_higher_band,
        'paye_3rd_lower_band' => $paye_3rd_lower_band,
        'paye_3rd_higher_band' => $paye_3rd_higher_band,
        'paye_4th_lower_band' => $paye_4th_lower_band,
        'pension' => $pension,
        'insurance' => $insurance,
        'standard_deductions' => $standard_deductions,
        'total_standard_deductions' => $total_standard_deductions,
      
        'bonus_name' => !is_null($bonus) ? $bonus_name : 'N/A',
        'bonus_amount' => !is_null($bonus_amount) ? $bonus_amount : 0,
        'achievements_name' => !is_null($achievements_name) ? $achievements_name : 'N/A',
        'achievements_amount' => !is_null($achievements_amount) ? $achievements_amount : 0,      
        'housing_allowance' => $housing_allowance,
        'transport_allowance' => $transport_allowance,
        'gross_earnings' => $gross_earnings,
        'total_overtime_amount' => $total_overtime_amount,
        'per' => Tax::where('security_number', "=", Auth::user()->security_number)->first(),
        'payee' => $payee,      
        'payDay' => date('d F Y', strtotime($end_date))
    ]);


if($share == 1){
    $password = $payslip->employee_id;
    $pdf->setEncryption($password);
    $fileName = $payslip->employee_id.'.pdf';
    $monthYear = date('F-Y', strtotime($end_date));
    $company = Auth::user()->security_number;
    Storage::disk("payslips")->put("$company/$monthYear/".$fileName, $pdf->output());
    //return \json_encode('Payslips Compiled Successfully');
}

else{
   // $password = $payslip->employee_id;
   //$pdf->setEncryption($password);
    $fileName = $payslip->employee_id.'.pdf';
    $monthYear = date('F-Y', strtotime($end_date));
    $company = Auth::user()->security_number;
    Storage::disk("payslips")->put("Dummy/$company/$monthYear/".$fileName, $pdf->output());
    //return \json_encode('Payslips Compiled Successfully');
}


    
}
return response()->json([
    'status'=>true,
    "message"=>"You have successfully! Compiled the PAYROLL For $monthYear"
    
    ]);


    }





    private function payroll(Request $request){
         
        $date = explode(' - ', $request->date);
       
        $start_date = date("Y-m-d",strtotime($date[0]));
        $end_date = date("Y-m-d",strtotime($date[1]));

        $attendances = Attendance::where('security_number',"=",Auth::user()->security_number)->whereBetween("date",[$start_date,$end_date])->pluck('employee_id')->toArray();
        $empIds = array_unique($attendances);

        $payslips = Employee::with([
            "cashAdvances" => function($q) use ($start_date,$end_date){
                $q->where('security_number',"=",Auth::user()->security_number)->whereBetween("date",[$start_date,$end_date]);
            },
            "attendances" => function($q) use ($start_date,$end_date){
                $q->where('security_number',"=",Auth::user()->security_number)->whereBetween("date",[$start_date,$end_date]);
            },
            "overtimes" => function($q) use ($start_date,$end_date){
                $q->where('security_number',"=",Auth::user()->security_number)->whereBetween("date",[$start_date,$end_date]);
            },
                       
        ])->whereIn("id",$empIds)->get();

        return $payslips;
    }



    public function downloadzip_show(){
        return View($this->folder.'create');
}




    public function downloadZip(Request $request){
    $Dummy = $request->dummy;    
    $month = $request->month;
    $year = $request->year;
    $company = Auth::user()->security_number;
    //$requesDt = date('F-Y');
    $requestDt = $month."-".$year;
    $zip = new ZipArchive();


if($Dummy == 1) {
    $fileName = "Dummy/$company/$requestDt.zip";
    try{
         if ($zip->open(public_path("PAYSLIPS/$fileName"), ZipArchive::CREATE) === true) {
             $files = File::files(public_path("PAYSLIPS/Dummy/$company/$requestDt"));
 
 
             foreach ($files as $key => $value) {
                 $relativeNameInZipFile = basename($value);
                 $zip->addFile($value, $relativeNameInZipFile);
             }
 
             $zip->close();
         }
 
         return response()->download(public_path("PAYSLIPS/$fileName"));
     
     }
 
 
     catch(\Throwable $e){
     
     Session::flash('warning_no_payslips', 'No Dummy Payslip found for the Month and Year Selected');
     return redirect()->back();
     }
 

}


else{
    $fileName = "$company/$requestDt.zip";
    try {
        if ($zip->open(public_path("PAYSLIPS/$fileName"), ZipArchive::CREATE) === true) {
            $files = File::files(public_path("PAYSLIPS/$company/$requestDt"));


            foreach ($files as $key => $value) {
                $relativeNameInZipFile = basename($value);
                $zip->addFile($value, $relativeNameInZipFile);
            }

            $zip->close();
        }

        return response()->download(public_path("PAYSLIPS/$fileName"));
    } catch(\Throwable $e) {
        Session::flash('warning_no_payslips', 'No Payslip found for the Month and Year Selected');
        return redirect()->back();
    }
}
           
}
}
