<?php

namespace App\Http\Controllers\Admin;

use DB;
use App\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Location;
use Auth;

class ProfileController extends Controller
{
	// Check if the principle has completed the KYC
    public function __construct()
    {
        $this->middleware('hasKYCBeenDone?', ['except' => 'admin.KYC.index']);
    }

	
	private $module = "admin.profile.";

    public function index(){
    	$admin = Auth()->user();
    	return View($this->module.'profile',[
    		'user'=>$admin,
    		'form_url'=>route($this->module."update")
    	]);
    }

    public function update(Request $request){
        $userpassword = DB::table("admins")->where("id",auth()->id())->first()->password;

    	if(isset($request->password) && Hash::check($request->password, $userpassword)){

    		$password = Hash::make($request->password);
    		if(isset($request->new_password)){
    			$password = Hash::make($request->new_password);
    		}

			if($request->hasFile('company_logo')){
            $company_logo = $request->file('company_logo')->store('COMPANY_LOGOS');  
  }
  if(!($request->hasFile('company_logo'))){
            $company_logo = "Null";  
  }
  
    		$data = [
    			'username' => $request->username,
				'company_address' => $request->company_address,
    			'email' => auth()->user()->email,
				'phone' => $request->phone,
				'company_logo' => $company_logo,
				'airtel_bulk_payments_ic_number' => $request->airtel_bulk_payments_ic_number,
    			'password' => $password,
    		];
    		Admin::find(auth()->id())->update($data);
    		return Redirect()->back()
    						->with('bgcolor','bg-success')
    						->withErrors(['errors'=>"Profile update successfully."]);
    	}

    	return Redirect()->back()
    					->with('bgcolor','bg-danger')
    					->withErrors(['errors'=>"Please enter your Password or Password doesn't Match."]);
    }
  
  
  
  
  
  // pin_company_location  
	
	public function pin_company_location(Request $request){
    $ip = $request->ip();
   if ($position = Location::get($ip)) {
     
			// Successfully retrieved position.
			$company = Admin::find(Auth::user()->id);
		$company->update([
			'latitude' => $position->latitude,
			'longitude' => $position->longitude  
		]);

		return Redirect()->back()
    						->with('bgcolor','bg-success')
    						->withErrors(['errors'=>"Location mapped and updated successfully."]);


        
		} else {
			return Redirect()->back()
    						->with('bgcolor','bg-error')
    						->withErrors(['errors'=>"Something went wrong, try again."]);
		}	
        
	}
  
  
  
  
  
  public function pin_branch_location(Request $request){
    $ip = $request->ip();
   if ($position = Location::get($ip)) {
     
		// Successfully retrieved position.
		$branch = \App\Branches::find(Auth::user()->branch_name);
		$branch->update([
			'latitude' => $position->latitude,
			'longitude' => $position->longitude  
		]);

		return Redirect()->back()
    						->with('bgcolor','bg-success')
    						->withErrors(['errors'=>"Location mapped and updated successfully."]);


        
		} else {
			return Redirect()->back()
    						->with('bgcolor','bg-error')
    						->withErrors(['errors'=>"Something went wrong, try again."]);
		}	
        
	}
  
  
  
  
  
}
