<?php

namespace App\Http\Controllers\Admin;
use App\Deduction;
use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminDeductionRequest;


class AdminDeductionController extends Controller
{
    private $folder = "admin.admindeduction.";

    public function index()
    {
        $get_data = route($this->folder.'getData');
        return View($this->folder.'index',[
            'get_data' => $get_data,
        ]);
    }
    
    public function getData()
    {
        $deductions = Deduction::where('security_number',"=",auth()->user()->security_number)->get();
        return View($this->folder.'content',[
            'deductions'=>$deductions,
            'add_new' => route($this->folder.'create'),
            'sum' => Deduction::where('security_number',"=",Auth::user()->security_number)->sum('amount'),
            'moveToTrashAllLink' => route($this->folder.'massDelete'),
        ]);
    }

    public function create()
    {
        return View($this->folder."create",[
            'form_store' => route($this->folder.'store'),
            ]);
    }

    public function store(AdminDeductionRequest $request)
    {
        Deduction::create($request->all());

        return response()->json([
            'status'=>true,
            'message'=>'New Deduction created successfully.',
            'redirect_to' => route($this->folder.'index')
            ]);
    }

    public function show(Deduction $deduction)
    {
        abort(404);
    }

    public function edit(Deduction $admindeduction)
    {
        
    	return View($this->folder.'edit',[
    		'admindeduction' => $admindeduction,
    		'form_update' => route($this->folder.'update',['admindeduction'=>$admindeduction]),
    	]);
    }

    public function update(AdminDeductionRequest $request, Deduction $admindeduction)
    {
       
        $admindeduction->update($request->all());
        return response()->json([
            'status'=>true,
            'message'=>'Deduction '.$admindeduction->name.' updated successfully.',
            'redirect_to' => route($this->folder.'index')
            ]);
    }

    public function destroy(Deduction $admindeduction)
    {
        $admindeduction->delete();
        return response()->json([
                'status' => true,
                'message' => "Your Record has been Deleted!",
                'getDataUrl' => route($this->folder.'getData'),
            ]);
    }

    public function massDelete(Request $request)
    {
        Deduction::whereIn('id',$request->ids)
                        ->delete();

        return response()->json([
                'status' => true,
                'message' => "Your all Record has been Deleted!",
                'getDataUrl' => route($this->folder.'getData'),
            ]);
    }
}
