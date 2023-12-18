<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Achievements;
use App\Bonus;
use App\Insurance;
use App\pension;
use App\Statutories as AppStatutories;
use App\Tax;
use App\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Auth;
use RealRashid\SweetAlert\Facades\Alert;
use App\StatutoryComplaints;

class Statutories extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
// Check if the principle has completed the KYC
public function __construct()
{
    $this->middleware('hasKYCBeenDone?', ['except' => 'admin.KYC.index']);
}
private $module = "admin.Statutories.";

public function pension_view()
{
$pension = pension::where('security_number',"=",Auth::user()->security_number)->get();    
if (Auth::user()->kyc_status==1) {
    return View($this->module.'pension',[
    'pension' => $pension
]);
}
}


public function insurance_view()
{
if (Auth::user()->kyc_status==1) {
    $insurance = Insurance::where('security_number',"=",Auth::user()->security_number)->get(); 
    return View($this->module.'insurance',[
        'insurance' => $insurance
    ]);
}
}




public function achievements_view()
{
$achievements = Achievements::where('security_number',"=",Auth::user()->security_number)->get();    
if (Auth::user()->kyc_status==1) {
    return View($this->module.'achievements',[
    'achievements' => $achievements
]);
}
}


public function bonus_view()
{
if (Auth::user()->kyc_status==1) {
    $bonuses = Bonus::where('security_number',"=",Auth::user()->security_number)->get(); 
    return View($this->module.'bonus',[
        'bonuses' => $bonuses
    ]);
}
}











    public function Tax()
{
    $Tax = Tax::where('security_number',"=",Auth::user()->security_number)->get(); 
    if (Auth::user()->kyc_status==1){
       
        return View($this->module.'Tax',[
            'Tax' => $Tax
        ]);
    }
   
}



public function StatutoriesList()
{
if (Auth::user()->kyc_status==1) {
    $statutories = AppStatutories::where('security_number',"=",Auth::user()->security_number)->get();
    return View($this->module.'view_statutories',compact('statutories'));
}
}

    public function TaxList()
{
    if (Auth::user()->kyc_status==1){
        $taxes = Tax::where('security_number',"=",Auth::user()->security_number)->get();
        return View($this->module.'view_taxes',compact('taxes'));
    }
   
}

public function collected_statutories()
    {
        $Reference = Admin::where('company_country', "=", Auth::user()->company_country)->where('tax_done',"=",1)->where('pension_done',"=",1)->where('insurance_done',"=",1)->first()->security_number;
        $Tax = Tax::where('security_number', "=", $Reference)->get();
        $insurance = Insurance::where('security_number', "=", $Reference)->get();
        $pension = pension::where('security_number', "=", $Reference)->get();
        return View($this->module.'collected_statutories', [
            'Tax' => $Tax,
            'pension' => $pension,
            'insurance' => $insurance,
            'Reference' => $Reference,
            'countryName' => Admin::where('company_country', "=", Auth::user()->company_country)->first()->company_country
        ]);
    }




    public function confirm_statutories(Request $request)
    {
      
        $validate = Validator::make($request->all(), [
            'tax' => 'nullable|string',
            'pension' => 'nullable|string',
            'insurance' => 'nullable|string',
            'reasons' => 'nullable|string|max:500',
            'Reference' => 'required|numeric'

        ]);


        if ($validate->fails()) {
            return Redirect()->route('admin.dashboard')->with([
                                'status'=>false,
                                'errors'=>$validate->errors()
                            ]);
        }

        if ($request->tax === 'tax') {
            $taxes_configured = Tax::where('security_number', "=", $request->Reference)->first();
            Tax::create([
                'fb' => $taxes_configured->fb,
                'fbp' => $taxes_configured->fbp,
                'sb' => $taxes_configured->sb,
                'sbp' => $taxes_configured->sbp,
                'tb' => $taxes_configured->tb,
                'tbp' => $taxes_configured->tbp,
                'fob' => $taxes_configured->fob,
                'fobp' => $taxes_configured->fobp,
                'security_number' => Auth::user()->security_number
            ]);
        }



        if ($request->pension === 'pension') {
            $pension_configured = pension::where('security_number', "=", $request->Reference)->first();
            pension::create([
                'pension' => $pension_configured->pension,
                'pension_name' => $pension_configured->pension_name,
                'applied_on' => $pension_configured->applied_on,
                'security_number' => Auth::user()->security_number
            ]);
        }




        if ($request->insurance === 'insurance') {
            $insurance_configured = Insurance::where('security_number', "=", $request->Reference)->first();
            Insurance::create([
                'insurance' => $insurance_configured->insurance,
                'insurance_name' => $insurance_configured->insurance_name,
                'applied_on' => $insurance_configured->applied_on,
                'security_number' => Auth::user()->security_number
            ]);
        }


       if (!is_null($request->reasons)) {
            StatutoryComplaints::create([
                'reasons' => $request->reasons,
                'security_number' => Auth::user()->security_number
            ]);
        }
      
      
      
      

        if (is_null($request->reasons) && is_null($request->tax) && is_null($request->pension) && is_null($request->insurance)) {
            Alert::toast('Please give us a feedback', 'warning');
            return Redirect()->route('admin.dashboard');
        }


        
        Alert::toast('Thank you!, we have recieved your request', 'success'); 
        return Redirect()->route('admin.dashboard');

        
    }



}
