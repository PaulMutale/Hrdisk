<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\{Branches as Branch, Admin};
use RealRashid\SweetAlert\Facades\Alert;
use Auth;
class Branches extends Controller
{

    // Check if the principle has completed the KYC
public function __construct()
{
    $this->middleware('hasKYCBeenDone?', ['except' => 'admin.KYC.index']);
}
    
    private $folder = "admin.branches.";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $branches = Branch::where('company_id',"=",Auth::user()->security_number)->get();
        return View($this->folder."index",[
            'branches' => $branches,
            ]); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        return View($this->folder."create",[
            'form_store' => route($this->folder.'store'),
            ]); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        Branch::create([
            'branch_name'=>$request->branch_name,
            'branch_location'=>$request->branch_location,
            'company_id'=>Auth::user()->security_number      
        ]);


Alert::success('BRANCH', "Branch name $request->branch_name located in $request->branch_location added successfully"); 
return Redirect()->route('admin.branches.create');
       
            }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function switch()
    {
        //
        $branches = Branch::where('company_id',"=",Auth::user()->security_number)->get();
        return View($this->folder."switch",[
            'branches' => $branches,
            'form_store' => route($this->folder.'switching'),
            ]); 
    }





    public function save(Request $request)
    {
        
        //
        $company = Admin::find(Auth::user()->id);
        $company->branch_name = $request->branch_name;
        $company->save();
        Alert::success('BRANCH SWITCHED', "You are now interacting with the new Branch"); 
        return Redirect()->route('admin.dashboard');   
       
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
$branch = Branch::find($id);
$branch_name =$branch->branch_name; 
$branch_location =$branch->branch_location; 


        return View($this->folder."edit",[
            'form_store' => route($this->folder.'update'),
            'branch_name' => $branch_name,
            'branch_location' => $branch_location,
            'branch_id' => $branch->branch_id,
            ]); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
$branch = Branch::find($request->branch_id);
      $update =  $branch->update([
            'branch_name'=>$request->branch_name,
            'branch_location'=>$request->branch_location,
            'company_id'=>Auth::user()->security_number      
        ]);

if($update){
    Alert::success('BRANCH UPDATED', "Branch name $branch->branch_name located in $branch->branch_location has been updated successfully"); 
    return Redirect()->route('admin.branches.index');   
}


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $branch = Branch::find($id);
        $delete = $branch->delete();
      
      // Check if the current branch has been deleted and get back to the default one
      $current_branch = Auth::user()->branch_name;
      $check_branch = Branch::find($current_branch);
      if(is_null($check_branch)){
        //The Current Branch has been deleted
      $current_user = Admin::find(Auth::user()->id);
      $current_user->branch_name = 0;
      $current_user->save();   
      }
      
      
        if($delete){
            Alert::success('BRANCH DELETED', "Branch name $branch->branch_name located in $branch->branch_location has been deleted successfully"); 
            return Redirect()->route('admin.branches.index');             
        }
    }
}
