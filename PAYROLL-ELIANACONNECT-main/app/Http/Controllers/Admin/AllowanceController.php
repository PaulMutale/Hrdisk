<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Allowance;
use App\Http\Requests\AllowanceRequest;
use Auth;
class AllowanceController extends Controller
{
    // Check if the principle has completed the KYC
    public function __construct()
    {
        $this->middleware('hasKYCBeenDone?', ['except' => 'admin.KYC.index']);
    }


    private $folder = "admin.allowance.";

    public function index()
    {
        $get_data = route($this->folder.'getData');
        return View($this->folder.'index',[
            'get_data' => $get_data,
            
        ]);

    }
    
    public function getData()
    {
        $allowances = Allowance::where('security_number',"=",Auth::user()->security_number)->get();
        return View($this->folder.'content',[
            'allowances'=>$allowances,
            'add_new' => route($this->folder.'create'),
            'sum' => Allowance::where('security_number',"=",Auth::user()->security_number)->sum('amount'),
            'moveToTrashAllLink' => route($this->folder.'massDelete'),
        ]);
    }

    public function create()
    {
        return View($this->folder."create",[
            'form_store' => route($this->folder.'store'),
            ]);
    }

    public function store(AllowanceRequest $request)
    {
        $allowance = Allowance::create($request->all());

        return response()->json([
            'status'=>true,
            'message'=>'New Allowance created successfully.',
            'redirect_to' => route($this->folder.'index')
            ]);
    }

    public function show(Allowance $allowance)
    {
        abort(404);
    }

    public function edit(Allowance $allowance)
    {
    	return View($this->folder.'edit',[
    		'allowance' => $allowance,
    		'form_update' => route($this->folder.'update',['allowance'=>$allowance]),
    	]);
    }

    public function update(AllowanceRequest $request, Allowance $allowance)
    {
        $allowance->update($request->all());
        return response()->json([
            'status'=>true,
            'message'=>'Allowance '.$allowance->name.' updated successfully.',
            'redirect_to' => route($this->folder.'index')
            ]);
    }

    public function destroy(Allowance $allowance)
    {
        $allowance->delete();
        return response()->json([
                'status' => true,
                'message' => "Your Record has been Deleted!",
                'getDataUrl' => route($this->folder.'getData'),
            ]);
    }

    public function massDelete(Request $request)
    {
        $allowances = Allowance::where('security_number',"=",Auth::user()->security_number)->whereIn('id',$request->ids)
                        ->delete();

        return response()->json([
                'status' => true,
                'message' => "Your all Record has been Deleted!",
                'getDataUrl' => route($this->folder.'getData'),
            ]);
    }
}
