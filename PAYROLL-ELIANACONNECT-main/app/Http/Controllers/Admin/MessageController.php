<?php

namespace App\Http\Controllers\Admin;

use App\Employee;
use App\tasks;
use App\Http\Controllers\Controller;
use App\Http\Requests\MessagesRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;
use App\Notifications\MessageNotification;
use Auth;
class MessageController extends Controller
{
// Check if the principle has completed the KYC
public function __construct()
{
    $this->middleware('hasKYCBeenDone?', ['except' => 'admin.KYC.index']);
}
    
    private $folder = "admin.message.";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        return View($this->folder."create",[
            'form_store' => route($this->folder.'store'),
            ]); 
    }
    
        //
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MessagesRequest $request)
    {
       
		

        if ($request->hasFile('agenda')) {
            $agenda = $request->file('agenda')->store('AGENDAS_FILES');
        }
        if (!($request->hasFile('agenda'))) {
            $agenda = "Null";
        }  

        tasks::create([
            'task'=>$request->task,
            'agenda'=>$agenda,
            'security_number'=>Auth::user()->security_number      
        ]);
       
        return response()->json([
            'status'=>true,
            'message'=>'Message sent to all employees portal successfully.',
            'redirect_to' => route('admin.message.create')
            ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
    }
}
