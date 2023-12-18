<?php

namespace App\Http\Controllers\SuperAdmin;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\{Admin,ContactUs,StatutoryComplaints,TrackUsers};
use RealRashid\SweetAlert\Facades\Alert;
class Analytics extends Controller
{
    //
  
  public function index(Request $request){

    $companies = Admin::count();
    $messages = ContactUs::count();
    $queries = StatutoryComplaints::count();
    $current_month_amount = 0;//Payments::whereYear('created_at',"=",date('Y'))->whereMonth('created_at',"=",date('m'))->sum('amount');
    $previous_months_amount = 0;//Payments::sum('amount');
    
    
    $chartPie = (new LarapexChart)->pieChart()
		->setSubtitle('')
		->addData([$companies,$messages, $queries]) // For Certain Number of Employees 
		->setLabels(["Companies $companies","Messages $messages", "Queries $queries"]);
        
       $chartAllowances = (new LarapexChart)->donutChart()
		->setTitle('Payments.')
		->setSubtitle('Setup.')
		->addData([$current_month_amount ,$previous_months_amount]) 
		->setLabels(["This Month $current_month_amount","Previous Months $previous_months_amount"]);
    
    
    
    
    
    return view('SuperAdmin.index',[
    'Companies' => Admin::get(),
    'Messages' => ContactUs::get(),
    'Stats_queries' => StatutoryComplaints::get(),
    'TrackUsers' => TrackUsers::latest()->get(),  
    'StartDate' => TrackUsers::get()->first()->created_at, 
    'EndDate' => TrackUsers::latest()->first()->created_at, 
    'chartPie' => $chartPie,
    'chartAllowances' => $chartAllowances
    
    ]);  
    
    
  }
  
public function filter(Request $request){
    $date2 = $request->year2.'-'.$request->month2.'-'.$request->day2;
    $date1 = $request->year1.'-'.$request->month1.'-'.$request->day1;
    
    $companies = Admin::whereBetween('created_at', [$date1, $date2])->count();
    $messages = ContactUs::whereBetween('created_at', [$date1, $date2])->count();
    $queries = StatutoryComplaints::whereBetween('created_at', [$date1, $date2])->count();
    $current_month_amount = 0;//Payments::whereYear('created_at',"=",date('Y'))->whereMonth('created_at',"=",date('m'))->sum('amount');
    $previous_months_amount = 0;//Payments::sum('amount');
    
    
    
    $chartPie = (new LarapexChart)->pieChart()
		->setSubtitle('')
		->addData([$companies,$messages, $queries]) // For Certain Number of Employees 
		->setLabels(["Companies $companies","Messages $messages", "Queries $queries"]); 
  
  
   $chartAllowances = (new LarapexChart)->donutChart()
		->setTitle('Payments.')
		->setSubtitle('Setup.')
		->addData([$current_month_amount ,$previous_months_amount]) 
		->setLabels(["This Month $current_month_amount","Previous Months $previous_months_amount"]);
        
  
   
    return view('SuperAdmin.index',[
    'Companies' => Admin::whereBetween('created_at', [$date1, $date2])->get(),
    'Messages' => ContactUs::whereBetween('created_at', [$date1, $date2])->get(),
    'Stats_queries' => StatutoryComplaints::whereBetween('created_at', [$date1, $date2])->get(),
    'TrackUsers' => TrackUsers::whereBetween('created_at', [$date1, $date2])->latest()->get(),    
    'StartDate' => $date1, 
    'EndDate' => $date2, 
    'chartPie' => $chartPie,
    'chartAllowances' => $chartAllowances
    ]);  
    
    
  }  
  
  
  
  
public function delete_company($id){
$trash_company = Admin::findOrFail(decrypt($id));
$trash_company->delete();

// Remove Company From Agents List 
$remove_from_agent = \App\Commisions::where('company_id',"=",$trash_company->security_number)->exists();

if($remove_from_agent){
$remove_from_agent = \App\Commisions::where('company_id',"=",$trash_company->security_number)->first();
$remove_from_agent->delete();

}


Alert::toast('Trashed!, Company Deleted Succcessfully', 'success'); 

return redirect()->route('superadmin.dashboard');   
  
  

}  
  
 
public function delete_message($id){
$trash_company = ContactUs::findOrFail(decrypt($id));
$trash_company->delete();
Alert::toast('Trashed!, Message Deleted Succcessfully', 'success'); 
return redirect()->route('superadmin.dashboard');
  

}  
  
  
    public function delete_commision($id){
$trash_commision = \App\Commisions::findOrFail(decrypt($id));
$trash_commision->delete();
Alert::toast('Trashed!, Payment Deleted Successfully', 'success'); 
return redirect()->route('superadmin.dashboard');
  

}  
  
  
  
  
    public function approve_commision($id){
$approve_commision = \App\Commisions::findOrFail(decrypt($id));
$approve_commision->is_approved = 1;
$approve_commision->save();
Alert::toast('Approved!, Commision Payment Approved Successfully', 'success'); 
return redirect()->route('superadmin.dashboard');
  

}  
  
  
  
}
