<?php

namespace App\Http\Controllers\Admin;

use App\{Employee,Schedule,Position,employee_kyc};
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\EmployeeRequest;
use Illuminate\Support\Facades\Hash;
use App\Notifications\InviteEmployee;
use App\Notifications\ApprovalLetter;
use App\DataTables\UsersDataTable;
use App\Mail\StaffCreated;
use DataTables;
use Auth;
use Illuminate\Support\Facades\Redirect;
use PDF;
use RealRashid\SweetAlert\Facades\Alert;

class DeletedEmployeeController extends Controller
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
            'get_data' => route($this->folder.'getDataTrashed'),
        ]);
    }

    public function getData(){
        
        return View($this->folder.'deleted_content',[
            'add_new' => route($this->folder.'create'),
            'PDF' => route($this->folder.'downloadEmployees'),
            'CSV' => route($this->folder.'export_csv_employee'),
            'EXCEL' => route($this->folder.'export_excel_employee'),
            'getDataTable' => route($this->folder.'getDataTableTrashed'),
            'moveToTrashAllLink' => route($this->folder.'massDelete'),
            'employees' => Employee::where('security_number',"=",Auth::user()->security_number)->onlyTrashed()->get(),
        ]);
    }

    //not use now : 03-05-2021 @auther : kdvamja
    public function getDataTable(UsersDataTable $dataTable){
        $employees = Employee::where('security_number',"=",Auth::user()->security_number)->onlyTrashed()->get();
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
                           <a href='".route($this->folder."restore",['employee_id'=>$data->employee_id])."'>Restore</a>
                            </div>";
                            return $btn;
                    })
                    ->rawColumns(['action','avatar','is_active','position','details'])
                    ->toJson();
    }

      
   

    public function restore($id)

    {
        $restored = Employee::onlyTrashed()->where('id', decrypt($id))->restore();
        if($restored){
            Alert::toast('Employee restored successfully ', 'success'); 
            return Redirect()->back();
            


        }

       
    }






    
  
  
  
}