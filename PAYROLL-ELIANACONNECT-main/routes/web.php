<?php
use App\Http\Controllers\Auth\AgentsAuth\AgentsAuth;
use App\Http\Controllers\PricingController;

/*application configration routes*/
/*
Route::group(['prefix'=>'clear'],function(){
    Route::get('cache', function () {
        \Artisan::call('cache:clear');
        dd("Cache is cleared");
    });
    Route::get('view', function () {
        \Artisan::call('view:clear');
        dd("View is cleared");
    });
    Route::get('route', function () {
        \Artisan::call('route:clear');
        dd("route is cleared");
    });
    Route::get('event', function () {
        \Artisan::call('event:clear');
        dd("Events is cleared");
    });
});

Route::get('config-cache', function () {
    \Artisan::call('config:cache');
    dd("Config is cached.");
});

Route::get('storage-link', function () {
    \Artisan::call('storage:link');
    dd("Storage link successfully.");
});

Route::get('sym-storage-link', function () {
    $targetFolder = $_SERVER['DOCUMENT_ROOT'].'/storage/app/public';
    $linkFolder = $_SERVER['DOCUMENT_ROOT'].'/public/storage';
    symlink($targetFolder,$linkFolder);
    dd('Symlink process successfully completed');
});

*/



/* end of application configration routes*/
Route::get('/', 'Admin\DashboardController@dashboard')->middleware('RedirectWhenNotLogin')->name('dash');

// checkin routes
Route::get('/checkin', "Admin\CheckInController@checkin")->name('admin.checkin.index');
Route::post('/checkin', "Admin\CheckInController@store")->name('admin.checkin.store');
Route::put('/checkin', "Admin\CheckInController@update")->name('admin.checkin.update');

Route::group(['namespace'=>'Admin','as'=>'admin.'], function () {
    /*
    Route::group(['namespace'=>'Auth'],function(){
        Route::get('/login','AuthController@showLogin')->name('showLogin');
        Route::post('/login','AuthController@login')->name('login');


        Route::get('/register','AuthController@showRegister')->name('showRegister');
        Route::post('/register','AuthController@register')->name('register');
    });
    */


    Route::group(['middleware'=>'auth'], function () {
        //Subscription Expired
        Route::get('/subscriptionExpired', function () {
            return "Subscription Expired";
        })->middleware('subscriptionExpired')->name('subscriptionExpired');





        //Log Out Middleware
        Route::post("/logout", 'LoginController@logout')->name('admin.logout');


        // media related routes
        Route::post('/media', 'HelperController@storeMedia')->name('storeMedia');
        Route::get('/media/showMediaFromTempFolder/{name}', 'HelperController@showMediaFromTempFolder')->name('showMediaFromTempFolder');
        Route::post('/media/base64EncodedData', 'HelperController@storeMediaBase64')->name('storeMediaBase64');
        Route::post('/media/removeMediaFromTempFolder/{name}', 'HelperController@removeMediaFromTempFolder')->name('removeMediaFromTempFolder');
        Route::post('/media/removeMedia/{model}/{model_id}/{collection}', 'HelperController@removeMedia')->name('removeMedia');
        Route::post('/confirm/password', 'HelperController@confirmPassword')->name('confirmPassword');


        //KYC profile route
        Route::post("/admin_kyc_profile", "PrincipleKYC@update")->name('KYC.update');
        //KYC profile route
        Route::get("/admin_kyc_index", "PrincipleKYC@index")->name('KYC.index');

        //KYC attachments route
        Route::post("/admin_kyc_attachments", "PrincipleKYC@updateAttachments")->name('KYC.updateAttachments');

        //KYC signature route
        Route::post("/admin_kyc_signature", "PrincipleKYC@updateSignature")->name('KYC.updateSignature');

        //KYC attachments view
        Route::get("/admin_attachments", "PrincipleKYC@attachments_view")->name('KYC.attachments_view');

        //KYC signature route
        Route::get("/admin_signature", "PrincipleKYC@signature_view")->name('KYC.signature_view');


        //admin profile route
        Route::get("/profile", "ProfileController@index")->name('profile.index');
        Route::post("/profile", "ProfileController@update")->name('profile.update');

        //position routes
        Route::resource('position', 'PositionController');
        Route::post('getdata/position', "PositionController@getData")->name('position.getData');
        Route::post('all-delete/position/', "PositionController@massDelete")->name('position.massDelete');

        //deduction routes
        Route::resource('deduction', 'DeductionController');
        Route::post('getdata/deduction', "DeductionController@getData")->name('deduction.getData');
        Route::post('all-delete/deduction/', "DeductionController@massDelete")->name('deduction.massDelete');

//deduction routes
Route::resource('admindeduction','AdminDeductionController');
Route::post('getdata/admindeduction',"AdminDeductionController@getData")->name('admindeduction.getData');
Route::post('all-delete/admindeduction/',"AdminDeductionController@massDelete")->name('admindeduction.massDelete');





      
       //Branches Route
        Route::resource('branches', "Branches");
        Route::get('branches_edit/{id}', "Branches@edit")->name('branches.edit');
        Route::get('branches_destroy/{id}', "Branches@destroy")->name('branches.destroy');
        Route::post('/branches_update', "Branches@update")->name('branches.update');
        Route::get('/branches_switch', "Branches@switch")->name('branches.switch');
        Route::post('/branches_switching', "Branches@save")->name('branches.switching');
      
      

        //Message Route
        Route::resource('message', "MessageController");

       //Company Policies Route
         Route::resource('policies', "CompanyPolicies");
      
      

        //Allowances routes
        Route::resource('allowance', 'AllowanceController');
        Route::post('getdata/allowance', "AllowanceController@getData")->name('allowance.getData');
        Route::post('all-delete/allowance/', "AllowanceController@massDelete")->name('allowance.massDelete');





        //schedule routes
        Route::resource('schedule', 'ScheduleController');
        Route::post('getdata/schedule', "ScheduleController@getData")->name('schedule.getData');
        Route::post('all-delete/schedule/', "ScheduleController@massDelete")->name('schedule.massDelete');

        //employee routes
        Route::resource('employee', 'EmployeeController');
        Route::post('getdata/employee', "EmployeeController@getData")->name('employee.getData');
        Route::post('get-employees-data', "EmployeeController@getDataTable")->name('employee.getDataTable');
        Route::post('all-delete/employee/', "EmployeeController@massDelete")->name('employee.massDelete');
        Route::get('employee_kyc/{id}', "EmployeeController@show")->name('employee.show');
        Route::get('employee_edit/{id}', "EmployeeController@edit")->name('employee.edit');
        Route::delete('employee_destroy/{id}', "EmployeeController@destroy")->name('employee.destroy');
        Route::get('downloadEmployees', "EmployeeController@downloadEmployees")->name('employee.downloadEmployees');
        Route::get('/export_csv_employee', [App\Http\Controllers\TestingMaatWebExcel::class, 'export_csv_employee'])->name('employee.export_csv_employee');
        Route::get('/export_excel_employee', [App\Http\Controllers\TestingMaatWebExcel::class, 'export_excel_employee'])->name('employee.export_excel_employee');




       










        Route::get('/deleted_employees', "DeletedEmployeeController@index")->name('employee.deleted_employees');
        Route::post('getdata_deleted/employee', "DeletedEmployeeController@getData")->name('employee.getDataTrashed');
        Route::post('get-employees-data_deleted', "DeletedEmployeeController@getDataTable")->name('employee.getDataTableTrashed');
        Route::get('restore_employee_deleted/{id}', "DeletedEmployeeController@restore")->name('employee.restore');









        //overtime routes
        Route::resource('overtime', 'OvertimeController');
        Route::post('getdata/overtime', "OvertimeController@getData")->name('overtime.getData');
        Route::post('get-overtime-data', "OvertimeController@getDataTable")->name('overtime.getDataTable');
        Route::post('all-delete/overtime/', "OvertimeController@massDelete")->name('overtime.massDelete');
        Route::get('overtime_edit/{id}', "OvertimeController@edit")->name('overtime.edit');
        Route::delete('overtime_destroy/{id}', "OvertimeController@destroy")->name('overtime.destroy');


        //Approvals Get

        Route::get('getdata/payroll', "approvePayroll@approveShow")->name('approvals.payroll');
        Route::get('getdata/loan', "approveLoan@approveShow")->name('approvals.loan');
        Route::get('getdata/overtime', "approveOvertime@approveShow")->name('approvals.overtime');
        Route::get('getdata/leave', "approveLeave@approveShow")->name('approvals.leave');





        //cashadvance routes
        Route::resource('cashadvance', 'CashAdvanceController');
        Route::post('postta/cashadvance', "CashAdvanceController@getData")->name('cashadvance.getData');
        Route::post('get-cashadvance-data', "CashAdvanceController@getDataTable")->name('cashadvance.getDataTable');
        Route::post('all-delete/cashadvance/', "CashAdvanceController@massDelete")->name('cashadvance.massDelete');
        Route::get('cashadvance_edit/{id}', "CashAdvanceController@edit")->name('cashadvance.edit');
        Route::put('/cashadvance_update',"CashAdvanceController@update")->name('cashadvance.update');
        Route::delete('cashadvance_destroy/{id}', "CashAdvanceController@destroy")->name('cashadvance.destroy');


        //Thirdparty Deductions
        Route::resource('third_party_deductions', 'ThirdPartyDeductions');
        Route::post('postta/third_party_deductions', "ThirdPartyDeductions@getData")->name('ThirdPartyDeductions.getData');
        Route::post('get-third_party_deductions-data', "ThirdPartyDeductions@getDataTable")->name('ThirdPartyDeductions.getDataTable');
        Route::post('all-delete/third_party_deductions/', "ThirdPartyDeductions@massDelete")->name('ThirdPartyDeductions.massDelete');
        Route::get('third_party_deductions_edit/{id}', "ThirdPartyDeductions@edit")->name('ThirdPartyDeductions.edit');
        //Route::get('/third_party_deductions_update',"ThirdPartyDeductions@update")->name('third_party_deductions.update');
        Route::get('third_party_deductions_destroy/{id}', "ThirdPartyDeductions@destroy")->name('ThirdPartyDeductions.destroy');






        //Leave Days
        Route::resource('leave_days', 'leaveDays');
        Route::post('posta/leave_days', "leaveDays@getData")->name('leave_days.getData');
        Route::post('get-leave_days-data', "leaveDays@getDataTable")->name('leave_days.getDataTable');
        Route::post('all-delete/leave_days/', "leaveDays@massDelete")->name('leave_days.massDelete');
        Route::get('leave_days_edit/{id}', "leaveDays@edit")->name('leave_days.edit');
        Route::put('/leave_days_update', "leaveDays@update")->name('leave_days.update');
        Route::delete('leave_days_destroy/{id}', "leaveDays@destroy")->name('leave_days.destroy');
        



        //onLeave
        Route::resource('onLeave', 'onLeave');
        Route::post('posta/onLeave', "onLeave@getData")->name('onLeave.getData');
        Route::post('get-onLeave-data', "onLeave@getDataTable")->name('onLeave.getDataTable');
        Route::post('all-delete/onLeave/', "onLeave@massDelete")->name('onLeave.massDelete');
        Route::get('onLeave_edit/{id}', "onLeave@edit")->name('onLeave.edit');
        Route::put('/onLeave_update', "onLeave@update")->name('onLeave.update');
        Route::get('onLeave_destroy/{id}', "onLeave@destroy")->name('onLeave.destroy');
        Route::get('leave_days_completed/{id}', "onLeave@completed")->name('leave_days.completed');







        //attendance routes
        Route::resource('attendance', 'AttendanceController');
        Route::post('getdata/attendance', "AttendanceController@getData")->name('attendance.getData');
        Route::post('get-attendance-data', "AttendanceController@getDataTable")->name('attendance.getDataTable');
        Route::post('all-delete/attendance/', "AttendanceController@massDelete")->name('attendance.massDelete');
        Route::get('attendance_edit/{id}', "AttendanceController@edit")->name('attendance.edit');
        Route::delete('attendance_destroy/{id}', "AttendanceController@destroy")->name('attendance.destroy');

        Route::get('/attended', "AttendanceController@attended")->name('attended');
        Route::post('getAttendedEmployees/attendance', "AttendanceController@getAttendedEmployees")->name('attendance.getAttendedEmployees');
        Route::post('get-attendance-employees', "AttendanceController@getAttendedEmployeesTable")->name('attendance.getAttendedEmployeesTable');




        //payroll routes
        Route::get('payroll', "PayrollController@index")->name('payroll.index');
        Route::post('getdata/payroll', "PayrollController@getData")->name('payroll.getData');
        Route::post('get-payroll-data', "PayrollController@getDataTable")->name('payroll.getDataTable');
        Route::get('payroll/download-payroll', "PayrollController@payrollExportPDF")->name('payroll.payrollExportPDF');
        Route::get('payroll/download-payslip', "PayrollController@payslipExportPDF")->name('payroll.payslipExportPDF');
        Route::get('payroll/download-zip', "PayrollController@downloadzip_show")->name('payroll.downloadzip');
        Route::post('payroll/downloadZip', "PayrollController@downloadZip")->name('payroll.downloadZip');


      
      
      
       // Bonus View
        Route::get('/bonus', [App\Http\Controllers\Admin\Statutories::class, 'bonus_view'])->name('bonus_view');

        // Achievements View
        Route::get('/achievements', [App\Http\Controllers\Admin\Statutories::class, 'achievements_view'])->name('achievements_view');


        // Bonus upload
        Route::post('/import_bonus', [App\Http\Controllers\TestingMaatWebExcel::class, 'import_bonus'])->name('import_bonus');

        // Achievements upload
        Route::post('/import_achhievement', [App\Http\Controllers\TestingMaatWebExcel::class, 'import_achievement'])->name('import_achievements');

      
      
      

        // Link Employees to third party
        Route::get('/import_employees_third_party_deductions', [App\Http\Controllers\Admin\ThirdPartyDeductions::class, 'index'])->name('import_employees_third_party_deductions');



        // Positions View
        Route::get('/positions_csv', [App\Http\Controllers\Admin\Organogram::class, 'positions'])->name('import_position_file');



        // Deductions View
        Route::get('/deductions_csv', [App\Http\Controllers\Admin\Organogram::class, 'deductions'])->name('import_deduction_file');





        // Positions upload
        Route::post('/import_positions', [App\Http\Controllers\TestingMaatWebExcel::class, 'positions'])->name('import_positions_csv');


        // Deduction upload
        Route::post('/import_deductions', [App\Http\Controllers\TestingMaatWebExcel::class, 'deductions'])->name('import_deductions_csv');


        // Link Employees to third party deductions
        Route::post('/import_employees_third_party_deductions', [App\Http\Controllers\TestingMaatWebExcel::class, 'import_employees_third_party_deductions'])->name('link_employees_csv');
        // Linked Employees
        Route::get('/linked_employees', [App\Http\Controllers\Admin\ThirdPartyDeductions::class, 'getData'])->name('linked_employees');


         // Linked Employees DataTable
         Route::get('/linked_employees_datatables', [App\Http\Controllers\Admin\ThirdPartyDeductions::class, 'getDataTable'])->name('linked_employees_getDataTable');


        // Linked Employees delete
        Route::delete('delete_linked_employees/{id}', [App\Http\Controllers\Admin\ThirdPartyDeductions::class, 'destroy'])->name('delete_linked_employees');


      
      
       // Pension View
        Route::get('/pension_view', [App\Http\Controllers\Admin\Statutories::class, 'pension_view'])->name('pension_view');

       // Insurance View
       Route::get('/insurance_view', [App\Http\Controllers\Admin\Statutories::class, 'insurance_view'])->name('insurance_view');
              // Tax View
        Route::get('/tax', [App\Http\Controllers\Admin\Statutories::class, 'Tax'])->name('tax_view');


        // Tax upload
         
        Route::post('/import_import_tax', [App\Http\Controllers\TestingMaatWebExcel::class, 'import_tax'])->name('import_tax');


        // Pension upload
        Route::post('/import_pension', [App\Http\Controllers\TestingMaatWebExcel::class, 'import_pension'])->name('import_pension');

        // Insurance upload
        Route::post('/import_insurance', [App\Http\Controllers\TestingMaatWebExcel::class, 'import_insurance'])->name('import_insurance');

        // Collected Statutories
        Route::get('collected_statutories', [App\Http\Controllers\Admin\Statutories::class, 'collected_statutories'])->name('collected_statutories');

        // Confirm Statutories
        Route::post('confirm_statutories', [App\Http\Controllers\Admin\Statutories::class, 'confirm_statutories'])->name('confirm_statutories');





     

        // Export Payroll Summary In CSV File

        Route::get('/export_excel', [App\Http\Controllers\TestingMaatWebExcel::class, 'export_excel'])->name('export_excel');
      
      
      // Pin Company Location 
  Route::get("/location", "ProfileController@pin_company_location")->name('pin_company_location');
      // Pin Branch Location 
  Route::get("/branch_location", "ProfileController@pin_branch_location")->name('pin_branch_location');
    });
});





Auth::routes(['verify' => true]);

Route::get('/registerUser/{planType}', [App\Http\Controllers\Auth\RegisterController::class, 'showRegistrationForm'])->name('registerUser');

Route::post('/register', [App\Http\Controllers\Auth\RegisterController::class, 'register'])->name('register');




 // Pricing For Employer
 Route::resource('pricing_plan', PricingController::class);



// Dashboard Routes
Route::get("/dashboard", 'Admin\DashboardController@dashboard')
->middleware(['verified'])
->name('admin.dashboard');

Route::group(['middleware'=>'superadmin','middleware'=>'auth'], function () {  

  //Super admin dashboard
Route::get("/superadmin_dashboard", 'SuperAdmin\Analytics@index')
->name('superadmin.dashboard');
  
 //Superadmin Filter Date range  
Route::post("/superadmin_dashboard", 'SuperAdmin\Analytics@filter')
->name('superadmin.filter');
  
  
//Superadmin Delete Company  
Route::get("superadmin_delete_company/{id}", 'SuperAdmin\Analytics@delete_company')
->name('superadmin.trash_company'); 
  
  //Superadmin Delete Message  
Route::get("superadmin_delete_message/{id}", 'SuperAdmin\Analytics@delete_message')
->name('superadmin.trash_message'); 
  
  
  //Superadmin Delete Pending Commsion  
Route::get("superadmin_delete_commision/{id}", 'SuperAdmin\Analytics@delete_commision')
->name('superadmin.trash_commision'); 
  
  
  //Superadmin Approve Pending Commsion  
Route::get("superadmin_approve_commision/{id}", 'SuperAdmin\Analytics@approve_commision')
->name('superadmin.approve_commision'); 
  
  
  
});




// Landing Page
Route::get('/', function () {
    return view('welcome');
})->middleware('TrackVisitors');

// Pricing
Route::get('/pricing', function () {
    return view('pricing');
})->name('pricing');

// Contact Us Page
Route::get('/contact_us', function () {
    return view('contact_us');
})->name('contact_us');

Route::post('/contact_us', [App\Http\Controllers\ContactUs::class, 'index'])
->middleware('guest')->name('contact_us');




Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])
->middleware('verified')->name('home');



// Agents 
Route::get('/agents_register_view', "Auth\selfAddEmployee\selfAddEmloyee@agents_register_view");
Route::get('/agents_login_view', "Auth\selfAddEmployee\selfAddEmloyee@agents_login_view");

Route::post('/selfAddAgents', "Auth\selfAddEmployee\selfAddEmloyee@agents_register")->name('agent.register');
Route::post('/selfLoginAgents', "Auth\selfAddEmployee\selfAddEmloyee@agents_login")->name('agent.login');






// Employees Section


// Employees Section  Testing
Route::get('/register_view', "Auth\selfAddEmployee\selfAddEmloyee@register_view");
Route::get('/login_view', "Auth\selfAddEmployee\selfAddEmloyee@login_view");

Route::post('/selfAddEmployee', "Auth\selfAddEmployee\selfAddEmloyee@register")->name('employee.register');
Route::post('/selfLoginmployee', "Auth\selfAddEmployee\selfAddEmloyee@login")->name('employee.login');





Route::group(['middleware'=>'onlyForEmployees'], function () {
    Route::get('/employees_dashboard', [App\Http\Controllers\Auth\selfAddEmployee\employeeDashboard::class,'dashboard']);//->name('employees_dashboard');



    // KYC :: Personal Details
    Route::get('/kyc_personal_details_view', [App\Http\Controllers\Employees\kyc::class,'kyc_personal_details_view'])->name('employees.kyc_personal_details_view');
    Route::post('/kyc_personal_details_submit', [App\Http\Controllers\Employees\kyc::class,'kyc_personal_details_submit'])->name('employees.kyc_personal_details_submit');



    // Company Details Submit
    Route::post('/kyc_company_details_submit', [App\Http\Controllers\Employees\kyc::class,'kyc_company_details_submit'])->name('employees.kyc_company_details_submit');




    // KYC :: Bank Details
    Route::get('/kyc_bank_details_view', [App\Http\Controllers\Employees\kyc::class,'kyc_bank_details_view'])->name('employees.kyc_bank_details_view');
    Route::post('/kyc_bank_details_submit', [App\Http\Controllers\Employees\kyc::class,'kyc_bank_details_submit'])->name('employees.kyc_bank_details_submit');

    // KYC :: Files Uploads
    Route::get('/kyc_files_details_view', [App\Http\Controllers\Employees\kyc::class,'kyc_files_details_view'])->name('employees.kyc_files_details_view');
    Route::post('/kyc_files_details_submit', [App\Http\Controllers\Employees\kyc::class,'kyc_files_details_submit'])->name('employees.kyc_files_details_submit');

    // KYC :: Digital Signature
    Route::get('/kyc_signature_details_view', [App\Http\Controllers\Employees\kyc::class,'kyc_signature_details_view'])->name('employees.kyc_signature_details_view');
    Route::post('/kyc_signature_details_submit', [App\Http\Controllers\Employees\kyc::class,'kyc_signature_details_submit'])->name('employees.kyc_signature_details_submit');

    //Cash Advance
    Route::get('/kyc_cashadvance_details_view', [App\Http\Controllers\Employees\loans::class,'kyc_cashadvance_details_view'])->name('employees.kyc_cashadvance_details_view');
    Route::post('/kyc_cashadvance_details_submit', [App\Http\Controllers\Employees\loans::class,'kyc_cashadvance_details_submit'])->name('employees.kyc_cashadvance_details_submit');


    //Leave Details
    Route::get('/leave_details_view', [App\Http\Controllers\Employees\leave::class,'leave_details_view'])->name('employees.leave_details_view');
    Route::post('/leave_details_submit', [App\Http\Controllers\Employees\leave::class,'leave_details_submit'])->name('employees.leave_details_submit');


    //Payroll Details
    Route::get('/payroll_details_view', [App\Http\Controllers\Employees\payroll::class,'payroll_details_view'])->name('employees.payroll_details_view');
    Route::post('/payroll_details_submit', [App\Http\Controllers\Employees\payroll::class,'payroll_details_submit'])->name('employees.payroll_details_submit');



    //Payslips Details
    Route::get('/payslip_details_view', [App\Http\Controllers\Employees\downloadPayslips::class,'payslip_details_view'])->name('employees.payslip_details_view');
    Route::post('/payslip_details_submit', [App\Http\Controllers\Employees\downloadPayslips::class,'payslip_details_submit'])->name('employees.payslip_details_submit');



    //Overtime
    Route::get('/overtime_details_view', [App\Http\Controllers\Employees\Overtime::class,'overtime_details_view'])->name('employees.overtime_details_view');
    Route::post('/overtime_details_submit', [App\Http\Controllers\Employees\Overtime::class,'overtime_details_submit'])->name('employees.overtime_details_submit');



 //Employee Change password
 Route::get('/change_password_view', [App\Http\Controllers\Employees\kyc::class,'change_password_view'])->name('employees.change_password_view');
 Route::post('change_password_submit/{id}', [App\Http\Controllers\Employees\kyc::class,'change_password_submit'])->name('employees.change_password_submit');


 //Employee Change password
 Route::get('/employee_profile', [App\Http\Controllers\Employees\kyc::class,'employee_profile'])->name('employees.employee_profile');
 
// Leave History
Route::get('/employee_leave_history', [App\Http\Controllers\Employees\Leave_History::class,'leave_history'])->name('employees.leave_history');

// Attendance History
Route::get('/employee_attendance_history', [App\Http\Controllers\Employees\Attendance_History::class,'attendance_history'])->name('employees.attendance_history');






    // log Out Employee
    Route::post('/logout_employee', "Auth\selfAddEmployee\selfAddEmloyee@logout")->name('logout_employee');
});






// Payments Route Group  

Route::group(['prefix'=>'payments'], function () {
 // payments
 Route::get('/payments', [App\Http\Controllers\Payments\Payments::class,'payments'])->name('payments.payments');

// visa
Route::get('/visa', [App\Http\Controllers\Payments\Payments::class,'visa'])->name('payments.visa');

// mtn
Route::get('/mtn', [App\Http\Controllers\Payments\Payments::class,'mtn'])->name('payments.mtn');


// airtel
Route::get('/airtel', [App\Http\Controllers\Payments\Payments::class,'airtel'])->name('payments.airtel');

// zamtel
Route::get('/zamtel', [App\Http\Controllers\Payments\Payments::class,'zamtel'])->name('payments.zamtel');
    

});




  //Attendance Controller View For Employees
  Route::get('/employee_attendance', [App\Http\Controllers\Employees\OnlineSignInSignOut::class,'qr_attendance_view']);
  
  
  //Attendance Controller Store For Employees
  Route::post('/employee_attendance', [App\Http\Controllers\Employees\OnlineSignInSignOut::class,'attendance'])->name('qrcode_attendance');
  
  