<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class approvePayroll extends Controller
{
    // Check if the principle has completed the KYC
    public function __construct()
    {
        $this->middleware('hasKYCBeenDone?', ['except' => 'admin.KYC.index']);
    }

    
    private $folder = "admin.employee.";

    public function approveShow()
    {
        
        return View($this->folder.'index',[
            'get_data' => route($this->folder.'getData'),
        ]);
    }

    public function getData(){
        
        return View($this->folder.'content',[
            'add_new' => route($this->folder.'create'),
            'getDataTable' => route($this->folder.'getDataTable'),
            'moveToTrashAllLink' => route($this->folder.'massDelete'),
            'employees' => Employee::where('security_number',"=",Auth::user()->security_number)->get(),
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
}
