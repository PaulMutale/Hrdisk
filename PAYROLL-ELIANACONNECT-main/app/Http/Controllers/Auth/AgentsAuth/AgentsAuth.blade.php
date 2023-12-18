<?php

namespace App\Http\Controllers\Auth\AgentsAuth;
use App\{Employee,selfAddEmployee};
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AgentsAuth extends Controller
{
    //

    public function register_view(){
        return "Good evening";
        return view('auth.Agents.register');
}   
    


    public function register(Request $request){
	
	
		$validate = Validator::make($request->all(), [
			'first_name' => 'required|string',
            'last_name' => 'required|string',
            'employee_email' => 'required|email|unique:self_add_employees,employees',
           	'password' => 'required|confirmed',
			
		],
		[
			'employee_email.unique' => "The Email address has already been registered.",
            'employee_number.unique' => "We already have an Employee with that employee number.",
			'employee_name.required' => "The Company name is required.",
			'employee_email.required' => 'The Email is required.',
			'employee_email.email' => 'Please enter  a valid email.',
		]);
		
		if($validate->fails() ){
			return Redirect()->back()->with([
								'status'=>false,
								'errors'=>$validate->errors()
							]);
		}


$data = ([
    'first_name' => $request->first_name,
    'last_name' => $request->last_name,
    'email' => $request->employee_email,
    'employee_start_date' => Carbon::now('GMT+2'),
    'employee_end_date' => "CONTRACT",
    'password' => Hash::make('password')
    
]);
        $new_agent = Employee::create($data);


        if($new_agent){
            $year = date('y');
            $employeeID = $new_agent->id;
            $employee_id = "AGENT".$year.$employeeID;
            $new_agent->employee_id = $employee_id;
            $new_agent->phone = $request->employee_phone_number;
            $new_agent->save();
          
          }
		

		$selfAdd = employee_kyc::create([
            'employee_email' => $request->employee_email,
            'employee_name' => $request->first_name ." ".$request->last_name         

        ]);
		//return "DONE";
		event(new Registered($selfAdd));
        
        return redirect('/agents_login_view');


} 






public function login_view(){
    // return "Good evening";
     return view('auth.Agents.login');
}   





public function login(Request $request){
   // return $request->_token;
    $validate = Validator::make($request->all(), [
        'email' => 'required|exists:employees',
        'employee_number' => 'required|exists:employees',
        'password' => 'required'
    ],
    [
        'email.exists' => "Email does not exists.",
        'employee_number.exists' => "Agent does not exist. Please check your agent number",
        'email.required' => 'The Email is required.',
        'email.email' => 'Please enter valid email.',
    ]);
    
    if($validate->fails()){
        return Redirect()->back()->with([
                            'status'=>false,
                            'errors'=>$validate->errors()
                        ]);
    }



    if (Auth::guard('Employees')->attempt(['email' => $request->email, 'password' => 
   $request->password,'employee_number' => $request->employee_number],$request->_token)) {   
    return redirect('/agents_dashboard');
}
return Redirect()->back()->withErrors(['errors'=>"Password doesn't match,Please try again."]);
}   


public function logout(Request $request)
	{
		Auth::guard('Employees')->logout();
		return redirect('/')->withErrors(['msg'=>'Logged out Successfuly.']);
	}

 

}
