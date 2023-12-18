<?php

namespace App\Http\Controllers;
use RealRashid\SweetAlert\Facades\Alert;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\{ImportUser,deductions,Structure,import_employees_third_party_deductions, import_insurance, import_pension, import_statutories,import_statutories_payee,import_bonus,import_achievement};
use App\Exports\{ExportUser,ExportUserCSV,ExportUserEXCEL};
use Illuminate\Support\Facades\Validator;
use App\User;
use Illuminate\Http\Request;

class TestingMaatWebExcel extends Controller
{
    private $folder = "admin.position.";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function export_excel()
    {
       // return Excel::download(new ExportUser, 'users.xlsx');
       return Excel::download(new ExportUser, 'payroll_summary.csv');
    }



    public function export_csv_employee()
    {
       // return Excel::download(new ExportUser, 'users.xlsx');
       return Excel::download(new ExportUserCSV, 'employees_list.csv');
    }




    public function export_excel_employee()
    {
       // return Excel::download(new ExportUser, 'users.xlsx');
       return Excel::download(new ExportUserEXCEL, 'employees_list.xlsx');
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function import_csv(Request $request)
    {
        Excel::import(new ImportUser, $request->file);
        return response()->json([
            'status'=>true,
            'message'=>'New Position created successfully.',
            'redirect_to' => route('admin.dashboard')
            ]);
        
    }



    public function positions(Request $request)
    {
          
      
        
            Excel::import(new Structure, $request->positions);
            Alert::success('Organisation Structure', 'Structure Created Successfully');     
            return Redirect()->route('admin.dashboard');
            
            
            
           //
    }
    




    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function deductions(Request $request)
    {
      
      
           
            Excel::import(new deductions, $request->deductions);
            Alert::success('Third Party Service Providers', 'Third Party Service Provider Created Successfully');     
            return redirect()->route('admin.dashboard');
            
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function import_employees_third_party_deductions(Request $request)
    {
      
            Excel::import(new import_employees_third_party_deductions, $request->import_employees);
            Alert::success('Third Party', 'Employees Successfully added to Third Parties');     
            return Redirect()->route('admin.dashboard');
    }
    
    
    
    
    
    
    
    public function import_pension(Request $request)
    {
        Excel::import(new import_pension, $request->import_pension);
            Alert::success('Pension', 'Pension Imported Successfully');     
            return Redirect()->route('admin.insurance_view');
    }



    public function import_insurance(Request $request)
    {
        Excel::import(new import_insurance, $request->import_insurance);
            Alert::success('Insurance', 'Insurance Imported Successfully');     
            return Redirect()->route('admin.dashboard');
    }



    public function import_tax(Request $request)
    {
        Excel::import(new import_statutories_payee, $request->import_statutories_payee);
            Alert::success('TAX BANDS', 'TAX BANDS Imported Successfully');     
            return Redirect()->route('admin.pension_view');
    }




public function import_bonus(Request $request)
    {
        Excel::import(new import_bonus, $request->import_bonus);
            Alert::success('Bonus', 'Bonus Imported Successfully');     
            return Redirect()->route('admin.dashboard');
    }



    public function import_achievement(Request $request)
    {
        Excel::import(new import_achievement, $request->import_achievements);
            Alert::success('Merit Award', 'Merit Award Imported Successfully');     
            return Redirect()->route('admin.dashboard');
    }












    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
