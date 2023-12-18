<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ContactUs as Messages;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Hash;
class ContactUs extends Controller
{
    //
    public function index(Request $request){
   
    Messages::create([
    'name'=>$request->name,
    'email'=>$request->email,
    'message'=>$request->message,
    
    ]);
    
 Alert::success('MESSAGE SENT', 'Thank you!, we have recieved your message, We will get in touch ASAP!'); 
 return Redirect('/');
    
    }
}
