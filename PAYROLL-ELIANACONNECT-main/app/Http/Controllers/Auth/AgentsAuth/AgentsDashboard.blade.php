<?php

namespace App\Http\Controllers\Auth\AgentsAuth;
use App\Providers\RouteServiceProvider;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AgentsDashboard extends Controller
{
    //
    public function dashboard(){
        //return "Hello";
       return view('agents/dashboard');
    }
}
