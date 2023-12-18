<?php

namespace App\Http\Controllers\Admin;

use App\{Employee,CashAdvance};
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CashAdvanceRequest;
use DataTables;
use Auth;

class CashAdvanceController extends Controller
{

    // Check if the principle has completed the KYC
    public function __construct()
    {
        $this->middleware('hasKYCBeenDone?', ['except' => 'admin.KYC.index']);
    }

    


    
    private $folder = "admin.cashadvance.";

    public function index()
    {
        return View($this->folder.'index',[
            'get_data' => route($this->folder.'getData'),
        ]);
    }

    public function getData(){
       if(Auth::user()->branch_name == 0){
     $CashAdvance = CashAdvance::where('security_number',"=",Auth::user()->security_number)->get(); 
     }
      
    else{
    $CashAdvance = CashAdvance::where('branch_name',"=",Auth::user()->branch_name)->where('security_number',"=",Auth::user()->security_number)->get();
    }
      
      
      
      
        $cashadvance = $CashAdvance;
        return View($this->folder.'content',[
            'add_new' => route($this->folder.'create'),
            // 'getDataTable' => route($this->folder.'getDataTable'),
            'moveToTrashAllLink' => route($this->folder.'massDelete'),
            'cashadvances' => $cashadvance,
        ]);
    }

    public function getDataTable(){
        if(Auth::user()->branch_name == 0){
     $CashAdvance = CashAdvance::where('security_number',"=",Auth::user()->security_number)->get(); 
     }
      
    else{
    $CashAdvance = CashAdvance::where('branch_name',"=",Auth::user()->branch_name)->where('security_number',"=",Auth::user()->security_number)->get();
    }
      
        $cashadvance = $CashAdvance;
        return Datatables::of($cashadvance)
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
    
    public function store(CashAdvanceRequest $request)
    {   
        $data = [
            'employee_id' => $request->employee_id,
            'rate_amount' => $request->employee_loan_amount,            
            'employee_total_repayment' => 0,
            'duration' => $request->employee_duration,
            'emi' => $request->employee_monthly,
            'loan_status' => 2,
            'title' => $request->title,
            'date' => $request->date,
            'security_number' => Auth::user()->security_number,
        ];
        CashAdvance::create($data);

        return response()->json([
            'status'=>true,
            'message'=>'New Salary Advance added successfully.',
            'redirect_to' => route($this->folder.'index')
            ]);
    }

    public function show(CashAdvance $cashadvance){   
        abort(404);
    }

    public function edit(CashAdvance $cashadvance,$id)
    {
       
        $employees = Employee::where('security_number',"=",Auth::user()->security_number)->get();
        $cashadvance = CashAdvance::where('employee_id',"=",decrypt($id))->latest()->first(); // Only Update Active Loans
        return View($this->folder.'edit',[
            'cashadvance' => $cashadvance,
            'form_update' => route($this->folder.'update',['cashadvance'=>$cashadvance]),
            'employees' => $employees,
        ]);
    }

    public function update(CashAdvanceRequest $request, CashAdvance $cashadvance)
    {
       $cashadvance = CashAdvance::where('employee_id',"=",$request->employee_id)->latest()->first();
        $data = [
            'employee_id' => $request->employee_id,
            'rate_amount' => $request->employee_loan_amount,            
            'employee_total_repayment' => is_null($request->employee_total_repayment) || empty($request->employee_total_repayment) ? 0 : $request->employee_total_repayment,
            'duration' => $request->employee_duration,
            'emi' => $request->employee_monthly,
            'loan_status' => 1,
            'title' => $request->title,
            'date' => $request->date,
            'security_number' => Auth::user()->security_number,
        ];
        $cashadvance->update($data);

        return response()->json([
            'status'=>true,
            'message'=> 'Salary advance Loan Approved successfully.',
            'redirect_to' => route($this->folder.'index')
            ]);
    }

    public function destroy(CashAdvance $cashadvance,$id)
    {   
        $deleteLoan = CashAdvance::findOrFail(decrypt($id));
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

    	$trash = CashAdvance::where('security_number',"=",Auth::user()->security_number)->whereIn('id',$request->ids)
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