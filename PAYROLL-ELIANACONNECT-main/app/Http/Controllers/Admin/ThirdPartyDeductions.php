<?php

namespace App\Http\Controllers\Admin;

use App\{Employee,CashAdvance,Deduction,ThirdPartyDeductions as ThirdPartyServices};
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CashAdvanceRequest;
use DataTables;
use Auth;

class ThirdPartyDeductions extends Controller
{

    // Check if the principle has completed the KYC
    public function __construct()
    {
        $this->middleware('hasKYCBeenDone?', ['except' => 'admin.KYC.index']);
    }

    


    
    private $folder = "admin.ThirdPartyDeductions.";

    public function index()
    {
        return View($this->folder.'create');
    }

    public function getData(){
     return View($this->folder.'content',[ 
        'get_data' => route('admin.linked_employees_getDataTable')
     ]);
    }

    public function getDataTable(Request $request){
        if ($request->ajax()) {
            $third_party_deductions = ThirdPartyServices::where('security_number', "=", Auth::user()->security_number)->get();
            return Datatables::of($third_party_deductions)
            ->addIndexColumn()
            ->addColumn('action', function ($third_party_deductions) {
                $btn = "<div class='table-actions'>
              <a data-href='".route("admin.delete_linked_employees",encrypt($third_party_deductions->id))."' class='delete cursure-pointer'><i class='ik ik-trash-2 text-danger'></i></a>
                </div>";
                return $btn;

            })
            ->rawColumns(['action'])
            ->make(true);
        }
    }

    public function create()
    {   
        $setup = Deduction::where('security_number',"=",Auth::user()->security_number)->get();
        return View($this->folder."create",[
            'form_store' => route($this->folder.'store'),
            'employees' => $setup,
        ]);
    }
    
    public function store(CashAdvanceRequest $request)
    {   
        $data = [
            'employee_id' => $request->employee_id,
            'amount' => $request->amount,            
            'deduction_code' => $request->deduction_code,
            'deduction_name' => $request->deduction_name,
            'date' => $request->date,
            'security_number' => Auth::user()->security_number,
        ];
        ThirdPartyServices::create($data);

        return response()->json([
            'status'=>true,
            'message'=>'New Third Party Service added successfully.',
            'redirect_to' => route($this->folder.'index')
            ]);
    }

    public function show(CashAdvance $cashadvance){   
        abort(404);
    }

    public function edit(CashAdvance $cashadvance,$id)
    {
       
        $employees = Employee::where('security_number',"=",Auth::user()->security_number)->get();
        $cashadvance = CashAdvance::where('employee_id',"=",decrypt($id))->firstOrFail();
        return View($this->folder.'edit',[
            'cashadvance' => $cashadvance,
            'form_update' => route($this->folder.'update',['cashadvance'=>$cashadvance]),
            'employees' => $employees,
        ]);
    }

    public function update(CashAdvanceRequest $request, CashAdvance $cashadvance)
    {
        $data = [
            'employee_id' => $request->employee_id,
            'rate_amount' => $request->employee_loan_amount,            
            'employee_total_repayment' => 0,
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

    public function destroy($id)
    {    
       
        $deleteService = ThirdPartyServices::findOrFail(decrypt($id));
       
        $trash = $deleteService->delete();
        if($trash){
             
            return response()->json([
                'status' => true,
                'message' => "Your Record has been Permanent Delete! Refresh to see new data",
                'getDataUrl' => route('admin.dashboard'),
            ]);
       
               
        }
        //return redirect()->route('admin.dashboard');
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