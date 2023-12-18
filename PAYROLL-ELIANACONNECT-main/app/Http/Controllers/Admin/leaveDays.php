<?php

namespace App\Http\Controllers\Admin;
use App\Http\Requests\leave_daysRequest;
use App\Http\Controllers\Controller;
use App\{Employee,leave_days};
use Illuminate\Http\Request;
use Auth;

class leaveDays extends Controller
{
    
// Check if the principle has completed the KYC
public function __construct()
{
    $this->middleware('hasKYCBeenDone?', ['except' => 'admin.KYC.index']);
}





    private $folder = "admin.leave_days.";

    public function index()
    {
        return View($this->folder.'index',[
            'get_data' => route($this->folder.'getData'),
        ]);
    }

    public function getData(){
        if(Auth::user()->branch_name == 0){
     $LeaveDays = leave_days::where('security_number',"=",Auth::user()->security_number)->get();
     }
      
    else{
    $LeaveDays = leave_days::where('branch_name',"=",Auth::user()->branch_name)->where('security_number',"=",Auth::user()->security_number)->get();
      
    }
      
      
      
      
        $leave_days = $LeaveDays;
        return View($this->folder.'content',[
            'add_new' => route($this->folder.'create'),
            // 'getDataTable' => route($this->folder.'getDataTable'),
            'moveToTrashAllLink' => route($this->folder.'massDelete'),
            'leave_days' => $leave_days,
        ]);
    }

    public function getDataTable(){
        
       if(Auth::user()->branch_name == 0){
     $LeaveDays = leave_days::where('security_number',"=",Auth::user()->security_number)->get();
     }
      
    else{
    $LeaveDays = leave_days::where('branch_name',"=",Auth::user()->branch_name)->where('security_number',"=",Auth::user()->security_number)->get();
      
    }
      
      
      
        return Datatables::of( $LeaveDays)
                    ->addIndexColumn()
                    ->addColumn('employee', function($data){
                    	return "<div class='row'><div class='col-md-3 text-center'><img src='".$data->employee->media_url['thumb']."' class='rounded-circle table-user-thumb'></div><div class='col-md-6 col-lg-6 my-auto'><b class='mb-0'>".$data->employee->first_name." ".$data->employee->last_name."</b><p class='mb-2' title='".$data->employee->employee_id."'><small><i class='ik ik-at-sign'></i>".$data->employee->employee_id."</small></p></div><div class='col-md-4 col-lg-4'><small class='text-muted float-right'></small></div></div>";
                    })
                    ->addColumn('action', function($data){
                            $btn = "<div class='table-actions'>
                            <a href='".route($this->folder."edit",['slug'=>$data->slug])."'><i class='ik ik-edit-2 text-dark'></i></a>
                            <a data-href='".route($this->folder."destroy",['slug'=>$data->slug])."' class='delete cursure-pointer'><i class='ik ik-trash-2 text-danger'></i></a>
                            </div>";
                            return $btn;
                    })
                    ->rawColumns(['employee','action'])
                    ->toJson();
    }

    public function create()
    {   
        $employees = Employee::where('security_number',"=",Auth::user()->security_number)->get();
        return View($this->folder."create",[
            'form_store' => route($this->folder.'store'),
            'employees' => $employees,
        ]);
    }
    
    public function store(leave_daysRequest $request)
    {   
        
        $data = [
            "employee_id" => $request->employee_id,
            "leave_name" => $request->leave_name,
            "exhausted_leaves" => $request->exhausted_leaves,
            "remaining_leaves" => $request->remaining_leaves,
            "leave_start_date" => $request->leave_start_date,
            "security_number" => $request->security_number,
            "status" => 1
        ];
        leave_days::create($data);

        return response()->json([
            'status'=>true,
            'message'=>'New Leave added manually successfully.',
            'redirect_to' => route($this->folder.'index')
            ]);
    }

    public function show(leave_days $leave_days){   
        abort(404);
    }

    public function edit(leave_days $leave_days,$id)
    {
       $employees = Employee::where('security_number',"=",Auth::user()->security_number)->get();
       $leave_days = leave_days::findOrFail(decrypt($id));
        return View($this->folder.'edit',[
            'leave_days' => $leave_days,
            'form_update' => route($this->folder.'update',['leave_days'=>$leave_days]),
            'employees' => $employees,
        ]);
     
       
    }

    public function update(leave_daysRequest $request, leave_days $leave_days)
    {
        

        $leave_days = leave_days::findOrFail($request->id);
        
        $data = [
            "employee_id" => $request->employee_id,
            "leave_name" => $request->leave_name,
            "exhausted_leaves" => $request->exhausted_leaves,
            "remaining_leaves" => $request->remaining_leaves,
            "security_number" => Auth::user()->security_number,
            "duration" => $request->duration,
            "status" => 1
        ];
        $leave_days->update($data);

      return response()->json([
                'status' => true,
                'message' => "Leave Days Status Updated Successfully!",
                 'redirect_to' => route($this->folder.'index'),
            ]);
    }
  
  
  
     public function destroy($id)
    {   
        $delete = leave_days::findOrFail(decrypt($id));
        $trash = $delete->delete();
        if($trash){
            return response()->json([
                'status' => true,
                'message' => "Your Record has been removed, refresh page!!",
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

    	$trash = leave_days::where('security_number',"=",Auth::user()->security_number)->whereIn('id',$request->ids)
                        ->delete();

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
}
