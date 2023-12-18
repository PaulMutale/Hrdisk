<?php

namespace App\Http\Controllers\Auth\selfAddEmployee;
use App\{Employee,employee_kyc,Position, Schedule};
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Carbon\Carbon;
use App\Notifications\InviteAgent;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class selfAddEmloyee extends Controller
{
    //

    public function register_view(){
       // return "Good evening";
        return view('auth.Employees.register');
}   
    

/*
    public function register(Request $request){
	
	
		$validate = Validator::make($request->all(), [
			'employee_name' => 'required|string',
            'employee_email' => 'required|email|unique:self_add_employees',
            'employee_number' => 'required|numeric|unique:self_add_employees',
			'password' => 'required|confirmed',
			
		],
		[
			'employee_email.unique' => "The Email address has already been registered.",
            'employee_number.unique' => "The Email address has already been registered.",
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


		

		$selfAdd = selfAddEmployee::create([
            'employee_email' => $request->employee_email,
            'employee_name' => $request->employee_name,
            'employee_number' => $request->employee_number,
            'password' => Hash::make($request->password)

        ]);
		//return "DONE";
		event(new Registered($selfAdd));
        
        return redirect('/login_view');


} 



*/





public function login_view(){
    // return "Good evening";
     return view('auth.Employees.login');
}   





public function login(Request $request){
   // return $request->_token;
    $validate = Validator::make($request->all(), [
        'email' => 'required|exists:employees',
        'security_number' => 'required|exists:admins',
        'password' => 'required'
    ],
    [
        'email.exists' => "Email does not exists.",
        'security_number.exists' => "Company does not exists.",
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
   $request->password,'security_number' => $request->security_number],$request->_token)) {   
    return redirect('/employees_dashboard');//->intended(RouteServiceProvider::EMPLOYEES_DASHBOARD);
   // return "LOGGEDN IN";
   //return redirect()->intended(route('admin.dashboard'));
}
return Redirect()->back()->withErrors(['errors'=>"Password doesn't match,Please try again."]);
}   

  
  
  
  
  
 
// Agents 

public function agents_register_view(){
    // return "Good evening";
     return view('auth.Agents.register');
}   
 


 public function agents_register(Request $request){
 
 
     $validate = Validator::make($request->all(), [
         'first_name' => 'required|string',
         'last_name' => 'required|string',
         'employee_email' => 'required|email|unique:employee_kycs',
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

//$company_id = 000000;
//$position_id = Position::where('security_number',"=",$company_id)->where('title',"=",'AGENT')->first()->id;
//$schedule_id = Schedule::where('security_number',"=",$company_id)->first()->id;


$data = ([
 'first_name' => $request->first_name,
 'last_name' => $request->last_name,
 'email' => $request->employee_email,
 'employee_start_date' => Carbon::now('GMT+2'),
 'employee_end_date' => "CONTRACT",
 'remark' => "FIELD AGENT",
 'password' => Hash::make($request->password)
 
]);
     $new_agent = Employee::create($data);


     if($new_agent){
         $year = date('y');
         $employeeID = $new_agent->id;
         $employee_id = "AGENT".$year.$employeeID;
         $new_agent->employee_id = $employee_id;
         $new_agent->save();
       
       }
     

     $selfAdd = employee_kyc::create([
         'employee_email' => $request->employee_email,
         'employee_name' => $request->first_name ." ".$request->last_name,
         'employee_number' => Employee::find($employeeID)->id,
         'password' => Hash::make($request->password)

     ]);
   
   // Send Login Credentials to the Agent
        $message = "Hello $request->first_name $request->first_last thank you for signing up as an agent for Eliana Connect. Please use the following credentials to Log In to the Agents Dashboard ";
        $email = $request->employee_email;
        $password = 'the password you created';
        $company_name = 'Eliana Connect';
        $agent = Employee::where('email', "=", $request->employee_email)->first();
        $agent_code = $agent->employee_id;
        $agent->notify(new InviteAgent($company_name, $message, $email, $password,$agent_code));
   
     //return "DONE";
     event(new Registered($selfAdd));
     Alert::success('CONGRATULATIONS', 'Congratulations for signing up on E-Systems as an Agent! Check your Email for Login Credentials');  
     return redirect('/agents_login_view');


} 






public function agents_login_view(){
 // return "Good evening";
  return view('auth.Agents.login');
}   





public function agents_login(Request $request){
// return $request->_token;
 $validate = Validator::make($request->all(), [
     'email' => 'required|exists:employees',
     'employee_id' => 'required|exists:employees',
     'password' => 'required'
 ],
 [
     'email.exists' => "Email does not exists.",
     'employee_id.exists' => "Agent does not exist. Please check your agent number",
     'email.required' => 'The Email is required.',
     'email.email' => 'Please enter valid email.',
 ]);
 
 if($validate->fails()){
     return Redirect()->back()->with([
                         'status'=>false,
                         'errors'=>$validate->errors()
                     ]);
 }

//dd(Auth::guard('Employees')->attempt(['email' => $request->email, 'password' => $request->password,'employee_id' => $request->employee_id],$request->_token));

//dd(substr($request->employee_id, 0, 5));
if (Auth::guard('Employees')->attempt(['email' => $request->email, 'password' => 
$request->password,'employee_id' => $request->employee_id],$request->_token) && substr($request->employee_id, 0, 5) == "AGENT") {   
 return redirect('/employees_dashboard');
}
return Redirect()->back()->withErrors(['errors'=>"Password doesn't match,Please try again."]);
}   



// End Agents Section  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  

public function logout(Request $request)
	{
		Auth::guard('Employees')->logout();
		return redirect('/')->withErrors(['msg'=>'Logged out Successfuly.']);
	}

 

}
