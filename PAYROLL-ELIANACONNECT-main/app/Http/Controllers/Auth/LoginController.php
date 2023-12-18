<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
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
        $this->middleware('guest')->except('logout');
    }



    public function login(Request $request)
	{

		$validate = Validator::make($request->all(), [
			'email' => 'required|exists:admins',
			'password' => 'required'
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

		if (Auth::guard()->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember_token'))) {

          if(Auth::user()->role == 1){
          
          return redirect()->route('superadmin.dashboard');
          
          }
          
			return redirect()->route('admin.dashboard');
		}
		return Redirect()->back()->withErrors(['errors'=>"Password doesn't match,Please try again."]);
	}



    public function logout(Request $request)
	{
		Auth::guard()->logout();
		return redirect()->route('login')->withErrors(['msg'=>'Logged out Successfuly.']);
	}

}
