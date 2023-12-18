<?php

namespace App\Http\Controllers\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Admin;
use Carbon\Carbon;

class RegisterController extends Controller 
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    

    public function register(Request $request){
	
	
		$validate = Validator::make($request->all(), [
			'email' => 'required|email|unique:admins',
            'pricing_plan' => 'required',
			'username' => 'required|string',
			'password' => 'required|confirmed',
            'country' => 'required|string',
            'company_tpin' => 'required|unique:admins',
            'employee_id' => 'nullable|exists:employees',
			
		],
		[
			'email.unique' => "The Email address has already been registered.",
			'username.required' => "The Company name is required.",
			'email.required' => 'The Email is required.',
			'email.email' => 'Please enter  a valid email.',
            'company_tpin.unique' => 'The company Tax number has already been registered.',
            'employee_id.exists' => 'This Agent does not match our records. Please leave the agent field empty if you were not invited by an agent',
		]);
		
		if($validate->fails() ){
			return Redirect()->back()->with([
								'status'=>false,
								'errors'=>$validate->errors()
							]);
		}


		

		$new_company = new Admin;
		$new_company->username = strtoupper($request->username);
        $new_company->company_address = $request->company_address;
        $new_company->company_country = $request->country;
		$new_company->email = $request->email;
        $new_company->company_tpin = $request->company_tpin;
		$new_company->payments_made_at = date('Y-m-d', strtotime("+30 days"));
        $new_company->password = Hash::make($request->password);
        $new_company->pricing_plan = $request->pricing_plan;
		$new_company->save();

        $Employer = Admin::where('email',"=",$request->email)->firstOrFail();
        $id = ($Employer->id).(random_int(11111,99999));
        $Employer->security_number = $id;
        $Employer->save();
      
      
      // Register Commision for an Agent Now
      if(isset($request->employee_id) && (!empty($request->employee_id)) && (!is_null($request->employee_id))){
       $agent = [
         'agent_id' => $request->employee_id,
         'company_id' => $Employer->security_number,
         'commisions' => 10
         ];
         
         \App\Commisions::create($agent);
      }
      
      

		event(new Registered($new_company));
        Alert::success('CONGRATULATIONS', 'Congratulations for signing up on E-Systems!'); 
        return redirect()->route('login');


} 








}
