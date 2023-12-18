<?php

namespace App\Http\Controllers\Admin;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\leave_daysRequest;
use App\Http\Controllers\Controller;
use App\{Employee,leave_days};
use Illuminate\Http\Request;
use Auth;

class onLeave extends Controller

    {

        // Check if the principle has completed the KYC
    public function __construct()
    {
        $this->middleware('hasKYCBeenDone?', ['except' => 'admin.KYC.index']);
    }
        
        private $folder = "admin.onLeave.";
    
        public function index()
        {
            return View($this->folder.'index',[
                'get_data' => route($this->folder.'getData'),
            ]);
        }
    
        public function getData(){
            $leave_days = leave_days::where('security_number',"=",Auth::user()->security_number)->where('status',"=",1)->get();
            return View($this->folder.'content',[
                'add_new' => route($this->folder.'create'),
                // 'getDataTable' => route($this->folder.'getDataTable'),
                'moveToTrashAllLink' => route($this->folder.'massDelete'),
                'leave_days' => $leave_days,
            ]);
        }
    
        public function getDataTable(){
            $leave_days = leave_days::where('security_number',"=",Auth::user()->security_number)->get();
            return Datatables::of($leave_days)
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
           $leave_days = leave_days::where('employee_id',"=",decrypt($id))->firstOrFail();
            return View($this->folder.'edit',[
                'leave_days' => $leave_days,
                'form_update' => route($this->folder.'update',['leave_days'=>$leave_days]),
                'employees' => $employees,
            ]);
         
           
        }
    
        public function update(leave_daysRequest $request, leave_days $leave_days)
        {
            
    
            $leave_days = leave_days::where('employee_id',"=",$request->employee_id)->first();
            
            $data = [
                "employee_id" => $request->employee_id,
                "leave_name" => $request->leave_name,
                "exhausted_leaves" => $request->exhausted_leaves,
                "remaining_leaves" => $request->remaining_leaves,
                "leave_start_date" => $request->leave_start_date,
                "security_number" => Auth::user()->security_number,
                "status" => 1
            ];
            $leave_days->update($data);
    
            return response()->json([
                'status'=>true,
                'message'=> $leave_days->title.' leave approved successfully.',
                'redirect_to' => route($this->folder.'index')
                ]);
        }
  
  
    public function completed($id)
    {
        

        $completed_leave_days = leave_days::findOrFail(decrypt($id));
        
        $data = [
           
            "status" => 4
        ];
        $completed_leave_days->update($data);
Alert::toast('Leave Days Marked as Completed Successfully!', 'success'); 
return Redirect()->route($this->folder.'index');
     
    }
  
  
  
  
  
  
  
  
  
    
        public function destroy(leave_days $leave_days,$id)
        {   
            $deleteLoan = Employee::findOrFail(decrypt($id));
            $trash = $deleteLoan->delete();
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
