<?php

namespace App\Http\Controllers\Auth\selfAddEmployee;
use App\Providers\RouteServiceProvider;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class employeeDashboard extends Controller
{
    //
    public function dashboard(){
        //return "Hello";
       return view('employees/dashboard');
    }
}
