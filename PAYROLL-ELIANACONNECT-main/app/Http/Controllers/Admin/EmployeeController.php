<?php

namespace App\Http\Controllers\Admin;

use App\{Employee,Schedule,Position,employee_kyc,CashAdvance,Attendance,leave_days};
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\EmployeeRequest;
use Illuminate\Support\Facades\Hash;
use App\Notifications\InviteEmployee;
use App\Notifications\ApprovalLetter;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Mail\StaffCreated;
use DataTables;
use Auth;
use PDF;

class EmployeeController extends Controller
{
// Check if the principle has completed the KYC
public function __construct()
{
    $this->middleware('hasKYCBeenDone?', ['except' => 'admin.KYC.index']);
}




    
    private $folder = "admin.employee.";

    public function index()
    {
        
        return View($this->folder.'index',[
            'get_data' => route($this->folder.'getData'),
        ]);
    }

    public function getData(){
      
     if(Auth::user()->branch_name == 0){
     $Employees = Employee::where('security_number',"=",Auth::user()->security_number)->get();  
     }
      
    else{
    $Employees = Employee::where('security_number',"=",Auth::user()->security_number)->where('branch_name',"=",Auth::user()->branch_name)->get();   
    }
       
      
      
      
        return View($this->folder.'content',[
            'add_new' => route($this->folder.'create'),
            'PDF' => route($this->folder.'downloadEmployees'),
            'CSV' => route($this->folder.'export_csv_employee'),
            'EXCEL' => route($this->folder.'export_excel_employee'),
            'getDataTable' => route($this->folder.'getDataTable'),
            'moveToTrashAllLink' => route($this->folder.'massDelete'),
            'employees' => $Employees,
        ]);
    }

    //not use now : 03-05-2021 @auther : kdvamja
    public function getDataTable(){
        $employees = Employee::where('security_number',"=",Auth::user()->security_number)->get();
        return Datatables::of($employees)
                    ->addIndexColumn()
                    ->addColumn('avatar', function($data){
                        $avatar = "<img src='".$data->mediaUrl['thumb']."' class='table-user-thumb'>";
                        return $avatar;
                    })
                    ->addColumn('is_active', function($data){
                        if($data->is_active == '1'){
                            $status = "<span class='success-dot' title='Published' title='Active Employee'></span>";
                        }else{
                            $status = "<i class='ik ik-alert-circle text-danger alert-status' title='In-Active Employee'></i>";
                        }
                        return $status;
                    })
                    ->addColumn('details', function($data){
                        $details = "<div class=''>
                        		<b>Gender :</b> <span>".$data->gender."</span></br>
                                <b>Employee Id :</b> <span>".$data->employee_id."</span></br>
                        		<b>Schedule :</b> <span>".$data->schedule->time_in.'-'.$data->schedule->time_out."</span></br>
                        		<b>Address :</b> <span>".$data->address."</span></br>
                        		</div>";
                        return $details;
                    })
                    ->addColumn('position', function($data){
                        return $data->position->title;
                    })
                    ->addColumn('action', function($data){
                            $btn = "<div class='table-actions'>
                            <a data-href='".route($this->folder.'show',['employee_id'=>$data->employee_id])."' class='show-employee cursure-pointer'><i class='ik ik-eye text-primary'></i></a>
                            <a href='".route($this->folder."edit",['employee_id'=>$data->employee_id])."'><i class='ik ik-edit-2 text-dark'></i></a>
                            <a data-href='".route($this->folder."destroy",['id'=>$data->id])."' class='delete cursure-pointer'><i class='ik ik-trash-2 text-danger'></i></a>
                            </div>";
                            return $btn;
                    })
                    ->rawColumns(['action','avatar','is_active','position','details'])
                    ->toJson();
    }

    public function create()
    {   
        $schedules = Schedule::where('security_number',"=",Auth::user()->security_number)->get();
        $positions = Position::where('security_number',"=",Auth::user()->security_number)->get();
        return View($this->folder."create",[
            'form_store' => route($this->folder.'store'),
            'schedules' => $schedules,
            'positions' => $positions,
        ]);
    }
    
    public function store(EmployeeRequest $request)
    {   
        
        $data = [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'schedule_id' => $request->schedule_id,
            'employee_start_date' => $request->employee_start_date,
            'employee_end_date' => is_null($request->employee_end_date) ? "PERMANENT" : $request->employee_end_date,
            'position_id' => $request->position_id,
            'remark' => $request->remark,
            'rate_per_hour' => $request->rate_per_hour,
            'salary' => $request->salary,
            'branch_name' => $request->branch_name,
            'is_active' => $request->is_active,
            'tpin_security_number' => $request->tpin_security_number,
            'password' => Hash::make('test1234'),
            'security_number' => $request->security_number,
        ];
        $employee = Employee::create($data);
      // Creating the Employee Number
        $new_employee = Employee::where('email',"=",$request->email)->first();
      if($new_employee){
        $year = date('y');
        $employeeID = $new_employee->id;
        $employee_id = "EMP".$year.$employeeID;
        $new_employee->employee_id = $employee_id;
        $new_employee->save();
      
      }
      //Creating the Employee Number Ends here
      
      
        //below here i save the image which is given by user and save that id to our parent table as a foreign key
        if($request->has('media') && file_exists(storage_path('media/uploads/'.$request->input('media')))){
            $media = $employee->addMedia(storage_path('media/uploads/' . $request->input('media')))->toMediaCollection('avatar');
            $employee->media_id = $media->id;
            $employee->save(); // save media_id here
        }


// Invite Employee 
        $company_name = Auth::user()->username;
        $message = "Hello $request->first_name $request->first_last you have been invited by $company_name to submit your personal details in order to be added to the company master file. ";
        $email = $request->email;
        $password = 'test1234';
        $employee = Employee::where('email',"=",$request->email)->first();
        $employee->notify(new InviteEmployee($company_name,$message,$email,$password));
       





        // Mail::to($employee->email)->send(new StaffCreated($data));
        return response()->json([
            'status'=>true,
            'message'=>'Invitation email sent successfully!',
            'redirect_to' => route('admin.dashboard')
            ]);
    }

    public function show(Employee $employee,$id){ 

        $employee = Employee::findOrFail(decrypt($id));  
        return View($this->folder.'show',[
            'employee'=>$employee,
        ]);
    }

    public function edit(Employee $employee,$id)

    {
        $employee = Employee::findOrFail(decrypt($id));
        $schedules = Schedule::where('security_number',"=",Auth::user()->security_number)->get();
        $positions = Position::where('security_number',"=",Auth::user()->security_number)->get();
        return View($this->folder.'edit',[
            'employee' => $employee,
            'form_update' => route($this->folder.'update',['employee'=>$employee]),
            'schedules' => $schedules,
            'positions' => $positions,
            'removeAvatar' => route('admin.removeMedia',[
                'model'=>'Employee',
                'model_id'=>$employee->id,
                'collection'=>'avatar']),
        ]);
    }

    public function update(EmployeeRequest $request, Employee $employee)
    {
     
      // Check if Employee has submitted yet
  $employee = Employee::find($request->id); 
  
 
        if ($request->is_active == 0) { // This is for rejecting the payroll application
          
       // In order to reject, the employee must first have applied to be added on the payroll, hence check
          if ($employee->status == 0) {
            Alert::error('Error','Employee has not applied to be on payroll yet');
            return response()->json([
                'status' => false,
                'message' => "Employee has not applied to be on payroll yet!",
                'redirect_to' => route('admin.dashboard'),
            ]);
        }
          // End Check
                   
          
            $employee_kyc = employee_kyc::where('employee_email', "=", $request->email)->count();

            if ($employee_kyc == 1) {
                employee_kyc::where('employee_email', "=", $request->email)->delete();
                // & Change payroll application status
                $employee->status = 0;
                $employee->is_active = 0;
                $employee->save();
                return response()->json([
                    'status' => true,
                    'message' => "Employee KYC cleared successfully",
                    'redirect_to' => route('admin.dashboard'),
                ]);
            }

            if ($employee_kyc > 1) {
                $employee_kyc_reset = employee_kyc::where('employee_email', "=", $request->email)->get();
                foreach ($employee_kyc_reset as $redo) {
                    $redo->delete();
                }
                // & Change payroll application status
                $employee->status = 0;
                $employee->is_active = 0;
                $employee->save();
                return response()->json([
                    'status' => true,
                    'message' => "Employee KYC's cleared successfully",
                    'redirect_to' => route('admin.dashboard'),
                ]);
            }
            
            else {
                return response()->json([
                    'status' => true,
                    'message' => "Employee KYC has already been cleared",
                    'redirect_to' => route('admin.dashboard'),
                ]);
            }
        }


      
      
            // Only Update records of Employee
        if($request->is_active == 4) {
            if(is_null($request->employee_password) && is_null($request->employee_new_password)){
                $employee_password = $employee->password;
            }


            if(is_null($request->employee_password) && isset($request->employee_new_password) || isset($request->employee_password) && is_null($request->employee_new_password)){
                Alert::error('Error','Password Confirmation does not match');
                    return response()->json([
                        'status' => false,
                        'message' => "Password Confirmation does not match!",
                        'redirect_to' => route('admin.dashboard'),
                    ]);
            }

            if(isset($request->employee_password) && isset($request->employee_new_password)){
                if($request->employee_password === $request->employee_new_password){
                    $employee_password = Hash::make($request->employee_new_password); 
                }
                else{
                    Alert::error('Error','Password Confirmation does not match');
                    return response()->json([
                        'status' => false,
                        'message' => "Password Confirmation does not match!",
                        'redirect_to' => route('admin.dashboard'),
                    ]);
                }
            }
            


                $data = [
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'phone' => $request->phone,
                'email' => $request->email,
                'birthdate' => $request->birthdate,
                'employee_start_date' => $request->employee_start_date,
                'employee_end_date' => $request->employee_end_date,
                'gender' => $request->gender,
                'schedule_id' => $request->schedule_id,
                'position_id' => $request->position_id,
                'branch_name' => $request->branch_name,
                'address' => $request->address,
                'remark' => $request->remark,
                'rate_per_hour' => $request->rate_per_hour,
                'salary' => $request->salary,
                'password' => $employee_password
            ];
            $employee->update($data);
          return response()->json([
            'status'=>true,
            'message'=> $employee->employee_id.' Employees records updated successfully.',
            'redirect_to' => route($this->folder.'index')
            ]);

        }

// Only Records update ends here
  
      
      
      
      
      
      
  if($request->is_active == 1){
   // An employee must first apply to be added on the apyroll to be added on it, Check that  
    if ($employee->status == 0) {
            Alert::error('Error','Employee has not applied to be on payroll yet');
            return response()->json([
                'status' => false,
                'message' => "Employee has not applied to be on payroll yet!",
                'redirect_to' => route('admin.dashboard'),
            ]);
        }
    
  // Checking ends
  
      
        $data = [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone' => $request->phone,
            'email' => $request->email,
            'birthdate' => $request->birthdate,
            'employee_start_date' => $request->employee_start_date,
            'employee_end_date' => is_null($request->employee_end_date) ? "PERMANENT" : $request->employee_end_date,
            'gender' => $request->gender,
            'schedule_id' => $request->schedule_id,
            'position_id' => $request->position_id,
            'address' => $request->address,
            'branch_name' => $request->branch_name,
            'remark' => $request->remark,
            'rate_per_hour' => $request->rate_per_hour,
            'salary' => $request->salary,
            'is_active' => $request->is_active    
            
        ];
        $employee->update($data);

      
      
      

// Send Approval Letter
$employee = Employee::where('email',"=",$request->email)->where('security_number',"=",Auth::user()->security_number)->first(); 
$title = Position::find($employee->position_id)->title;
$employee_signature = employee_kyc::where('employee_email',"=",$request->email)->latest()->first();
$sig = $employee_signature->borrower_photo_signature; 

if ($employee->approval_letter != 1){ // replace with 1 after testing 
    $pdf = PDF::loadView($this->folder."approval_letter", [
        'employee' => $employee,
        'title'=> $title,
        'sig'=> $sig
    ])
    ->setOptions(['defaultFont' => 'sans-serif','isRemoteEnabled' => true]);

    $attachment = $pdf->output();
                 
    $employee->notify(new ApprovalLetter($attachment));


     // Update that approval letter has been sent
     
     $employee->approval_letter = 1;
      $employee->status = 1;
     $employee->save();

// Close Update 
     
}

// End sending approval letter





        if($request->has('media') && file_exists(storage_path('media/uploads/'.$request->input('media')))){
            $media = $employee->addMedia(storage_path('media/uploads/' . $request->input('media')))->toMediaCollection('avatar');
            $employee->media_id = $media->id;
            $employee->save(); // save media_id here
        }

        return response()->json([
            'status'=>true,
            'message'=> $employee->employee_id.' updated successfully.',
            'redirect_to' => route($this->folder.'index')
            ]);
    }
      
      
    }

    protected function permanentDelete($id){
    
    // Soft Delete Employee
        $trash = Employee::find($id);
        if (count($trash->getMedia('avatar')) > 0) {
            foreach ($trash->getMedia('avatar') as $media) {
                $media->delete();
            }
        }
        $trash->delete();
        
        
     // Erase Cash Advance History
     $cash_advance = CashAdvance::where('employee_id',"=",$id)->get();
       if (count($cash_advance) > 0) {
            foreach ($cash_advance as $cash_advances) {
               $cash_advances->delete();
            }
        }
        
        
         // Erase Attendance History
     $attendance = Attendance::where('employee_id',"=",$id)->get();
       if (count($attendance) > 0) {
            foreach ($attendance as $attendances) {
               $attendance->delete();
            }
        }
        
        
        
          // Erase Leave Days History
     $leave_days = leave_days::where('employee_id',"=",$id)->get();
       if (count($leave_days) > 0) {
            foreach ($leave_days as $leave_days_duration) {
               $leave_days_duration->delete();
            }
        }
        
        
        
        
        return true;
    }

    protected function massPermanentDelete($ids){
        $employees = Employee::where('security_number',"=",Auth::user()->security_number)->whereIn('id',$ids)
                        ->get();
        foreach ($employees as $employee) {
            $this->permanentDelete($employee->id);
        }
        return true;
    }

    public function destroy(Request $request,$id)
    {   
        $trash = $this->permanentDelete(decrypt($id));
        if($trash){
            return response()->json([
                'status' => true,
                'message' => "Your Record has been Permanent Delete!",
                'getDataUrl' => route($this->folder.'getData'),
            ]);
        }
        return response()->json([
            'status' => false,
            'message' => "Something went wrong please try later!",
            'getDataUrl' => route($this->folder.'getData'),
        ]);
    }

    public function massDelete(Request $request){
        //this is for permanent delete all record
        $trash = $this->massPermanentDelete($request->ids);

        if($trash){
            return response()->json([
                'status' => true,
                'message' => "Your Record has been Permanent Delete!",
                'getDataUrl' => route($this->folder.'getData'),
            ]);
        }
        return response()->json([
            'status' => false,
            'message' => "Something went wrong please try later!",
            'getDataUrl' => route($this->folder.'getData'),
        ]);
    }
  
  
  
  
  // download employees list     
    
    public function downloadEmployees(){
        $pdf = PDF::loadView($this->folder."downloadEmployees", [
        'employees' => Employee::where('security_number',"=",Auth::user()->security_number)->get(),
        'logo' => 'LOGOS_UPLOADS/'.Auth::user()->company_logo,
       ])->setOptions(['defaultFont' => 'sans-serif','isRemoteEnabled' => true]);
       $pdf->setPaper(array(0,0,1500,1500), 'landscape');
       return $pdf->download('EmployeesList.pdf');

    } 
  
  
  
}