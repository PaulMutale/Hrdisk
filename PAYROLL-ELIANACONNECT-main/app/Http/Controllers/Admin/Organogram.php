<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class Organogram extends Controller
{
    // Check if the principle has completed the KYC
    public function __construct()
    {
        $this->middleware('hasKYCBeenDone?', ['except' => 'admin.KYC.index']);
    }
    private $module = "admin.organogram.";

    public function deductions()
    {
    if (Auth::user()->kyc_status==1) {
        return View($this->module.'deductions');
    }
}

        public function positions()
    {
        if (Auth::user()->kyc_status==1){
           
            return View($this->module.'positions');
        }
       
    }

}






