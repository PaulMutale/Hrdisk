<?php

namespace App\Http\Controllers\Employees;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\{employee_kyc,Employee,Admin, Position, Schedule};
use App\selfAddEmployee;
use Illuminate\Http\Request;

class kyc extends Controller
{
    //
    public function kyc_personal_details_view(){
      $check_kyc = employee_kyc::where('employee_email',"=",Auth::guard('Employees')->user()->email)->latest()->first();
      
        if(!empty($check_kyc->borrower_photo_signature)){
            Session::flash('warnings', 'You have already submitted your KYC');
            return redirect('/employees_dashboard');//->route($this->folder.'dashboard');
              
        }
        return view('employees/kyc/kyc_personal_details_view');
    }

    public function kyc_personal_details_submit(Request $request){
        $validate = Validator::make($request->all(), [
			'first_name' => 'required|string',
            'last_name' => 'required|string',
            'phone' => 'required',          
            'nok' => 'required|string',
            'name_of_nok' => 'required|string',
            'phone_of_nok' => 'required|numeric',         
            'email' => 'required|email|exists:employees',
            'birthdate' => 'required',
			'address' => 'required|string',
            'gender' => 'required|string',
            'remark' => 'nullable|string',
            'security_number' => 'required|string',
            'tpin' => 'required|string',
			
		]);
       
		if($validate->fails() ){
			return Redirect('/employees_dashboard')->with([
								'status'=>false,
								'errors'=>$validate->errors()
							]);
		}



// Check if the Company exists
$check_company = Admin::where('security_number',"=",$request->security_number)->first();
      
        if(!$check_company){
            Session::flash('warnings', 'This Company does not match our records');
            return redirect('/employees_dashboard');//->route($this->folder.'dashboard');
          
        }

$Employee =  Employee::find(Auth::guard('Employees')->user()->id);
$Employee->update([
    'phone' => $request->phone,
    'address' => $request->address,
    'gender' => $request->gender,
    'tpin' => $request->tpin,
    'birthdate' => $request->birthdate,
]);

      
       
// Copy to kyc employees
$kyc = employee_kyc::create([
           
    'employee_name' => $request->first_name . ' '.$request->last_name,
    'employee_email' => $request->email,            
    'employee_address' => $request->address,
    'employee_gender' => $request->gender,  
    'nok' => $request->nok,            
    'name_of_nok' => $request->name_of_nok,
    'phone_of_nok' => $request->phone_of_nok,
    ]);


      

// Get Company Profile and Vacancies
$company = Admin::where('security_number',"=",$request->security_number)->first(); 
$company_name = $company->username;
$profile_vacancies =  Position::where('security_number',"=",$request->security_number)->get(); 
$profile_schedule =  Schedule::where('security_number',"=",$request->security_number)->get(); 
if($profile_vacancies && $profile_schedule){
 return view('employees/kyc/company_details',compact('profile_vacancies','profile_schedule','company_name'));
}

else{

    Session::flash('warnings', 'This Company has either no positions available or it has not set up any reporting time');
    return redirect('/employees_dashboard');//->route($this->folder.'dashboard');
    
}

        
    }



    //Company Details Submit

    public function kyc_company_details_submit(Request $request){
       
        $validate = Validator::make($request->all(), [
			'position_id' => 'required|string',
            'schedule_id' => 'required',
            			
		]);
       
		
		if($validate->fails() ){
			return Redirect('/employees_dashboard')->with([
								'status'=>false,
								'errors'=>$validate->errors()
							]);
		}



        
$employee_company = Employee::where('email',"=",Auth::guard('Employees')->user()->email)->first();
            
// Retrieve vacancies 
$positions = explode(',',$request->position_id);
$vacancies = $positions[1];
//dd($vacancies); 

$Positions_update = Position::find($positions[0]); 

if($vacancies == 0){
    Session::flash('warnings', 'There are currently no vacancies available for the positioned assigned. Please contact the company principal to rectify this');
    return redirect()->route('/employees_dashboard');
}

if ($vacancies >= 1) {
    $remaining_vacancies = round($vacancies - 1);
// Update vacancies 
    $Positions_update->update([
        'vacancies' => $remaining_vacancies,
        'head_count' => $Positions_update->head_count + 1
    ]);

    $employee_company->position_id = $request->position_id;
    $employee_company->schedule_id = $request->schedule_id;
    $employee_company->save();




    return view('employees/kyc/kyc_bank_details_view');
}
    }








// Bank Details

    public function kyc_bank_details_submit(Request $request){
       
        $validate = Validator::make($request->all(), [
			'employee_bank_name' => 'nullable|string',
            'employee_bank_branch' => 'nullable|string',
            'employee_bank_account_number' => 'nullable|numeric',
            'employee_bank_account_type' => 'nullable|string',
			'employee_mobile_money_number' => 'nullable|numeric',
            'employee_mobile_money_name' => 'nullable|string',
			
		]);
       		
		if($validate->fails() ){
			return Redirect('/employees_dashboard')->with([
								'status'=>false,
								'errors'=>$validate->errors()
							]);
		}



        
           $current_employee = employee_kyc::where('employee_email',"=",Auth::guard('Employees')->user()->email)->latest()->first();
            
            $current_employee->employee_bank_name = is_null($request->employee_bank_name) ? "NULL" : $request->employee_bank_name;
            $current_employee->employee_bank_branch = is_null($request->employee_bank_branch) ? "NULL" : $request->employee_bank_branch;            
            $current_employee->employee_bank_account_number =is_null($request->employee_bank_account_number) ? "NULL" : $request->employee_bank_account_number;
            $current_employee->employee_bank_account_type = is_null($request->employee_bank_account_type) ? "NULL" : $request->employee_bank_account_type;
            $current_employee->employee_mobile_money_number = is_null($request->employee_mobile_money_number) ? "NULL" : $request->employee_mobile_money_number;
            $current_employee->employee_mobile_money_name = is_null($request->employee_mobile_money_name) ? "NULL" : $request->employee_mobile_money_name;
            $current_employee->save();
            
            
                   

        return view('employees/kyc/files_uploads_view');
    }


    public function kyc_files_details_submit(Request $request){
        $validate = Validator::make($request->all(), [
			'employee_medicals' => 'nullable|mimes:pdf|max:2048', //1 mb = 1024 kb 
            'employee_passport_photo' => 'required|mimes:png,jpg,jpeg|max:5120',
            
			
		]);
       
		
		if($validate->fails() ){
			return Redirect('/employees_dashboard')->with([
								'status'=>false,
								'errors'=>$validate->errors()
							]);
		}


        $current_employee = employee_kyc::where('employee_email',"=",Auth::guard('Employees')->user()->email)->latest()->first();
        
        $current_employee->employee_medicals = is_null($request->file('employee_medicals')) ? "NULL" : $request->file('employee_medicals')->store('Employee_Files');
        $current_employee->employee_passport_photo = $request->file('employee_passport_photo')->store('Employee_Files');
        $current_employee->save();   
        

        return view('employees/kyc/kyc_e_signature_view');
    }





public function kyc_signature_details_submit(Request $request){
    
    
      $validate = Validator::make($request->all(), [
			'signed' => 'required|string'            
            			
		]);
       
		
		if($validate->fails() ){
			return Redirect('/employees_dashboard')->with([
								'status'=>false,
								'errors'=>$validate->errors()
							]);
		}
    
    
    
    
    
    
    
     $current_employee = employee_kyc::where('employee_email',"=",Auth::guard('Employees')->user()->email)->latest()->first();
     $folderPath = public_path('files/');
        
        $image = explode(";base64,", $request->signed);
              
        $image_type = explode("image/", $image[0]);
           
        $image_type_png = $image_type[1];
           
        $image_base64 = base64_decode($image[1]);
        
        $image_path = 'borrower_photo_signature/'.uniqid() . '.'.$image_type_png; 
     
        $file = $folderPath . $image_path;
              
        $current_employee->borrower_photo_signature = $image_path;         
        
        file_put_contents($file, $image_base64);
     
        $current_employee->save();

    Session::flash('success', 'KYC Completed successfully');
    return redirect('/employees_dashboard');//->route($this->folder.'dashboard');

           
       
    }


// Employees Change password view  
public function change_password_view(){
    return view('employees/kyc/change_password_view');
}


// Employees Change password Submit  
public function change_password_submit(Request $request,$id){

    $validate = Validator::make($request->all(), [
        'old_password' => 'required|string',        
        'password' => 'required|confirmed',
    ]);
    
    
    if($validate->fails() ){
        return Redirect('/employees_dashboard')->with([
                            'status'=>false,
                            'errors'=>$validate->errors()
                        ]);
    }

    $oldPas = Employee::find(decrypt($id));
    if(Hash::check($request->old_password, $oldPas->password)){
    $oldPas->update([
       'password' => Hash::make($request->password)
    ]);  
    
    Session::flash('success', 'Password update Completed successfully');
    return redirect()->route('employees.change_password_view');

    }

    Session::flash('warnings', 'The old password does not match our records');
    return redirect()->route('employees.change_password_view');
    
}



public function employee_profile(){
    $employee_passport_photo = employee_kyc::where('employee_email',"=",Auth::guard('Employees')->user()->email)->latest()->first();
    return view('employees/kyc/employee_profile',
[
 'employee_passport_photo' => $employee_passport_photo   
]);   
}

}
