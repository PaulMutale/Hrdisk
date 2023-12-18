<?php

namespace App\Http\Controllers\Payments;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Payments extends Controller
{
    //
    public function payments(){
        return view('payments.payments');
    }
    public function visa(){
        return view('payments.visa');
    }
    public function mtn(){
        return view('payments.mtn');
    }
    public function airtel(){
        return view('payments.airtel');
    }
    public function zamtel(){
        return view('payments.zamtel');
    }
}
