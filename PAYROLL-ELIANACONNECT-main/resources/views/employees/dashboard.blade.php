<!--Agent Dashboard--> 
@if(substr(Auth::guard('Employees')->user()->employee_id,0,5) == 'AGENT')

@include('Agents.header')
@include('Agents.dashboard')
@include('Agents.footer')

<!--Agent Dashboard Ends here--> 
@else







<!--Employee Dashboard starts here--> 
@include('employees/menu_header')

 <main class="content">      

<div class="container-fluid p-0">
<!--Validation Errors starts here -->   
@if($errors->any())
    <div class="alert bg-danger text-light alert-dismissible fade show" role="alert">
        @foreach ($errors->all() as $error)
            <span>{!! $error !!}</span>
        @endforeach
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <i class="ik ik-x"></i>
        </button>
    </div>
    @endif
<hr>
<!--End Validation Errors-->


 <!--Error warning-->
 @if (Session::has('warnings'))
 <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <i class="fa-regular fa-bell"></i>
        <strong>Hello {{Auth::guard('Employees')->user()->first_name}} !</strong> you have some bad feedbacks, 
       
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
             {!! Session::get('warnings') !!}
    </div>
 @endif
<!--Error warnings ends here-->


<!--Success-->
@if (Session::has('success'))
 <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fa-regular fa-bell"></i>
        <strong>Hello {{Auth::guard('Employees')->user()->first_name}} !</strong> you have some good feedbacks, 
       
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
             {!! Session::get('success') !!}
    </div>
 @endif
<!--Sucess ends here-->
<br>


@php 
$time = time();
date_default_timezone_set('Africa/Cairo');


$logged_in = \App\Attendance::whereDate('date',"=",date('Y-m-d', $time))->where('employee_id',"=",Auth::guard('Employees')->user()->id)->whereNotNull('time_in')->first();
$logged_out = \App\Attendance::whereDate('date',"=",date('Y-m-d', $time))->where('employee_id',"=",Auth::guard('Employees')->user()->id)->whereNotNull('time_out')->first();

$pricing_plan = \App\Admin::where('security_number',"=",Auth::guard('Employees')->user()->security_number)->first()->pricing_plan;

@endphp





<h1 class="h3 mb-3">Hi <strong>{{Auth::guard('Employees')->user()->first_name}} {{Auth::guard('Employees')->user()->last_name}} </strong> Welcome to the Employees Dashboard</h1>

<!--Login In Status-->  
<span class="text-success"> <i class="mdi mdi-arrow-bottom-right"></i> @if($logged_in)
                                     Checked In: {{ $logged_in->time_in }}
                                     @else 
                                     
Check-In via A QRCODE FROM YOUR HR
                                       
                                     @endif </span>
                                     <br><br>
                                <span class="text-danger"> @if($logged_out)
                              Checked Out: {{ $logged_out->time_out }}
                                     @else 
                                    Check-Out via A QRCODE FROM YOUR HR
                                                                        
                                     @endif </span>



<!--Log Out Status-->




<hr>
  <strong>Employee ID: {{Auth::guard('Employees')->user()->employee_id}} </strong>
<!--Show Reminders here -->   
 <br><br>


    <style>
        
    
    ul.notes li {
      margin: 10px 40px 50px 0px;
      float: left;
    }
    
    ul.notes li, ul.tag-list li {
      list-style: none;
    }
    
    ul.notes li div small {
      position: absolute;
      top: 5px;
      right: 5px;
      font-size: 10px;
    }
    
    div.rotate-1 {
      -webkit-transform: rotate(-6deg);
      -o-transform: rotate(-6deg);
      -moz-transform: rotate(-6deg);
    }
    
    div.rotate-2 {
      -o-transform: rotate(4deg);
      -webkit-transform: rotate(4deg);
      -moz-transform: rotate(4deg);
      position: relative;
      top: 5px;
    }
    
    .lazur-bg {
      background-color: #23c6c8;
      color: #ffffff;
    }
    
    .red-bg {
      background-color: #ed5565;
      color: #ffffff;
    }
    
    .navy-bg {
      background-color: #1ab394;
      color: #ffffff;
    }
    
    .yellow-bg {
      background-color: #f8ac59;
      color: #ffffff;
    }
    
    ul.notes li div {
      text-decoration: none;
      color: #000;
      display: block;
      height: 160px;
      width: 160px;
      padding: 1em;
      -moz-box-shadow: 5px 5px 7px #212121;
      -webkit-box-shadow: 5px 5px 7px rgba(33, 33, 33, 0.7);
      box-shadow: 5px 5px 7px rgba(33, 33, 33, 0.7);
      -moz-transition: -moz-transform 0.15s linear;
      -o-transition: -o-transform 0.15s linear;
      -webkit-transition: -webkit-transform 0.15s linear;
    }
    
    
    </style>
 <div class="container bootstrap snippets bootdey shadow-sm p-3 mb-5 bg-white rounded">   
    
    <h4>Employee Notice Board</h4>
<br>
    
        <div class="row">
        @php 
            $reminders =  \App\tasks::where('security_number',"=",Auth::guard('Employees')->user()->security_number)->whereMonth('created_at',"=",date('m'))->whereYear('created_at',"=",date('Y'))->latest()->get();
               
            @endphp
            <ul class="notes">
       
                @forelse($reminders as $reminder)
                <li>
                    <div class="rotate-1 lazur-bg">
                        <small>{{$reminder->created_at}}</small>
                        <hr>
                        <p>Reminder</p>
                        <span>{{$reminder->task}}</span>
                        <a href="LOGOS_UPLOADS/{{$reminder->agenda}}" class="text- pull-right"><i class="fa fa-download "></i></a>
                    </div>
                  <br>
                </li>  
                @empty
                <li>
                    <div class="rotate-1 lazur-bg">
                        <small>{{date('F-Y')}}</small>
                        <br>
                        <h4>No Reminder</h4>
                        <p>Your reminders will appear here</p>
                        <hr>
                        <a text-danger ><i class="fa fa-download "> Agenda</i></a>
                    </div>
                </li> 
               @endforelse 
            </ul>  
        </div>
    </div>
    
    
    
    
    
    
     <!--End Reminders-->
    
    


<hr>









<h4>Joining Employee Workspace</h4>
<br>


        
            <div class="row">
                <div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row" >
                                <div class="col mt-0">
                                    <h5 class="card-title">KYC</h5>
                                </div>

                                <div class="col-auto">
                                    <div class="stat text-primary">
                                    <i class="fas fa-sticky-note"></i>
                                    </div>
                                </div>
                            </div>
                            <h4 class="mt-1 mb-3" style="font-weight: bold;">
                           
                           <a style="color:black"  href="{{route('employees.kyc_personal_details_view')}}">Finish Now</a>											
                       
                       
                       </h4>
                           
                            
                            <div class="mb-0">
                                <span class="text-danger"> <i class="mdi mdi-arrow-bottom-right"></i>Finish your KYC</span>
                                <span class="text-muted">Finish</span>
                            </div>
                        </div>
                    </div>
                    </div>





                    <div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col mt-0">
                                    <h5 class="card-title">Payroll</h5>
                                </div>

                                <div class="col-auto">
                                    <div class="stat text-primary">
                                    <i class="fa fa-credit-card"></i>
                                        
                                        </div>
                                </div>
                            </div>
                            <h4 class="mt-1 mb-3" style="font-weight: bold;">
                           
                            <a style="color:black" href="{{route('employees.payroll_details_view')}}">Add me on Payroll</a>											
                        
                        
                        </h4>
                            <div class="mb-0">
                               <span class="text-muted">Apply</span>
                            </div>
                        </div>
                    </div>
                </div>
</div>



<!--Statuses-->
<br><br>
<h4>In-service Employee Workspace</h4>
<br>

<!--For Freee Plan-->
@if($pricing_plan == 'freePlan')  
<div class="row premiumPlan">
                <div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col mt-0">
                                    <h5 class="card-title">Leave Days</h5>
                                </div>

                                <div class="col-auto">
                                    <div class="stat text-primary">
                                    <i class="fa fa-calendar"></i>
                                    </div>
                                </div>
                            </div>
                          
                   @php 
                          
$employee_status = \App\Employee::where('email',"=",Auth::guard('Employees')->user()->email)->first();        
$leave_days = \App\leave_days::where('employee_id',"=",$employee_status->id)->where('status',"=",1)->latest()->first();
$start_time = \Carbon\Carbon::parse($employee_status->employee_start_date);
$current_time = \Carbon\Carbon::parse(\Carbon\Carbon::now());
$months = $start_time->diffInMonths($current_time, false); 

if(is_null($leave_days)){
    $exhausted_leaves = 0;
    $remaining_leaves = round($months * 2);
    }
else{
   $exhausted_leaves = $leave_days->exhausted_leaves;
   $remaining_leaves = $leave_days->remaining_leaves;
  }                          
                          
                          
                          @endphp
                          
                          
                          
                            <h4 class="mt-1 mb-3" style="font-weight: bold;"><a style="color:black" href="{{route('employees.leave_details_view')}}">Leave Days</a></h4>
                            <div class="mb-0">
                                <span class="text-success"><i href="{{route('employees.leave_details_view')}}" class="mdi mdi-arrow-bottom-right"></i>Leave balance : {{$remaining_leaves}}</span>
                                
                            </div>
                        </div>
                    </div>
                    </div>
                    



                    <!--Leave Status -->   

                    @php 
                $employee =  \App\Employee::where('email',"=",Auth::guard('Employees')->user()->email)->first();
                $leave = $employee->leave_days->where('status',"=",1)->first()
                   
                @endphp


                    <div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
                    <div class="card">
                        <div class="card-body">
                        <div class="row">
                            <div class="col mt-0">
                                    <h5 class="card-title">Leave Status</h5>
                                </div>

                                <div class="col-auto">
                                    <div class="stat text-primary">
                                        <i class="fa fa-clock-o"></i>
                                    </div>
                                </div>
                            </div>
                            <h4>Leave Status</h4>
        <div class="mb-0">
            <span class="text-danger"> <i class="mdi mdi-arrow-bottom-right"></i>Accepted: @if($employee)
                {{ $employee->leave_days->where('status',"=",1)->count()}}
                 @else  
                 0 
                 @endif </span>
            <span class="text-muted">Pending:  @if($employee)
                {{ $employee->leave_days->where('status',"=",2)->count()}}
                 @else  
                 0 
                 @endif</span>
        </div>
                        </div>
                    </div>
                  </div>

                    <!--End Leave Status--> 

            </div>

    





<div class="row premiumPlan">
   

<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col mt-0">
                                    <h5 class="card-title">Salary Advance</h5>
                                </div>

                                <div class="col-auto">
                                    <div class="stat text-primary">
                                    <i class="fas fa-money-bill-wave-alt"></i>
                                        
                                        </div>
                                </div>
                            </div>
                            <h4 class="mt-1 mb-3" style="font-weight: bold;">
                            
                            <a style="color:black" href="{{route('employees.kyc_cashadvance_details_view')}}">Get a salary advance</a>											
                        
                        
                        </h4>
                            <div class="mb-0">
                               <span class="text-muted">Apply</span>
                            </div>
                        </div>
                    </div>
                </div>



<!-- Salary adavance status -->    

<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col mt-0">
                                    <h5 class="card-title">Salary Advance Status</h5>
                                </div>

                                <div class="col-auto">
                                    <div class="stat text-primary">
                                    <i class="fa fa-money-bill"></i>
                                    </div>
                                </div>
                            </div>
                            <h4 class="mt-1 mb-3" style="font-weight: bold;"><a style="color:black" href="">Active:@if($employee)
                                {{ $employee->cashAdvances->where('loan_status',"=",1)->count() }}
                                 @else  
                                 0 
                                 @endif </a></h4>
                            <div class="mb-0">
                                <span class="text-success"><i class="mdi mdi-arrow-bottom-right"></i>Pending: @if($employee)
                                    {{ $employee->cashAdvances->where('loan_status',"=",2)->count() }}
                                     @else  
                                     0 
                                     @endif</span>
                                <span class="text-muted">Balance:  @if($employee)
                                    ZMW {{ $employee->cashAdvances->where('loan_status',"=",1)->sum('rate_amount') - $employee->cashAdvances->where('loan_status',"=",1)->sum('total_repayments') }}
                                     @else  
                                     0 
                                     @endif</span>
                            </div>
                        </div>
                    </div>
                    </div>
                  



<!--End salary advance status-->
</div>

                


<div class="row premiumPlan">
<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                            <div class="col mt-0">
                                    <h5 class="card-title">Overtime</h5>
                                </div>

                                <div class="col-auto">
                                    <div class="stat text-primary">
                                        <i class="fa fa-clock-o"></i>
                                    </div>
                                </div>
                            </div>
                            <h4 class="mt-1 mb-3" style="font-weight: bold;"><a style="color:black" href="{{route('employees.overtime_details_view')}}">Work overtime</a></h4>
                            <div class="mb-0">
                                <span class="text-danger"> <i  class="mdi mdi-arrow-bottom-right"></i>Worked overtime</span>
                                <span class="text-muted">Apply</span>
                            </div>
                        </div>
                    </div>
                </div>




<!--overtime status-->
                    <div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                            <div class="col mt-0">
                                    <h5 class="card-title">Overtime</h5>
                                </div>

                                <div class="col-auto">
                                    <div class="stat text-primary">
                                        <i class="fa fa-clock-o"></i>
                                    </div>
                                </div>
                            </div>
                            <h4>Overtime Status</h4>
                            <div class="mb-0">
                                <span class="text-danger"> <i class="mdi mdi-arrow-bottom-right"></i>Total:  @if($employee)
                                    {{ $employee->overtimes->where('status',"=",1)->count()}}
                                     @else  
                                     0 
                                     @endif </span>
                                <span class="text-muted">Pending:  @if($employee)
                                    {{ $employee->overtimes->where('status',"=",2)->count()}}
                                     @else  
                                     0 
                                     @endif </span>
                            </div>                 
                        </div>
                    </div> 
                  </div> 
                  <!--End overtime status--> 
</div>

<!--End Free Plan here-->





@else






<!--For Paid Plan-->      

<div class="row">
                <div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col mt-0">
                                    <h5 class="card-title">Leave Days</h5>
                                </div>

                                <div class="col-auto">
                                    <div class="stat text-primary">
                                    <i class="fa fa-calendar"></i>
                                    </div>
                                </div>
                            </div>
                          
                   @php 
                          
$employee_status = \App\Employee::where('email',"=",Auth::guard('Employees')->user()->email)->first();        
$leave_days = \App\leave_days::where('employee_id',"=",$employee_status->id)->where('status',"=",1)->latest()->first();
$start_time = \Carbon\Carbon::parse($employee_status->employee_start_date);
$current_time = \Carbon\Carbon::parse(\Carbon\Carbon::now());
$months = $start_time->diffInMonths($current_time, false); 

if(is_null($leave_days)){
    $exhausted_leaves = 0;
    $remaining_leaves = round($months * 2);
    }
else{
   $exhausted_leaves = $leave_days->exhausted_leaves;
   $remaining_leaves = $leave_days->remaining_leaves;
  }                          
                          
                          
                          @endphp
                          
                          
                          
                            <h4 class="mt-1 mb-3" style="font-weight: bold;"><a style="color:black" href="{{route('employees.leave_details_view')}}">Leave Days</a></h4>
                            <div class="mb-0">
                                <span class="text-success"><i href="{{route('employees.leave_details_view')}}" class="mdi mdi-arrow-bottom-right"></i>Leave balance : {{$remaining_leaves}}</span>
                                
                            </div>
                        </div>
                    </div>
                    </div>
                    



                    <!--Leave Status -->   

                    @php 
                $employee =  \App\Employee::where('email',"=",Auth::guard('Employees')->user()->email)->first();
                $leave = $employee->leave_days->where('status',"=",1)->first()
                   
                @endphp


                    <div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
                    <div class="card">
                        <div class="card-body">
                        <div class="row">
                            <div class="col mt-0">
                                    <h5 class="card-title">Leave Status</h5>
                                </div>

                                <div class="col-auto">
                                    <div class="stat text-primary">
                                        <i class="fa fa-clock-o"></i>
                                    </div>
                                </div>
                            </div>
                            <h4>Leave Status</h4>
        <div class="mb-0">
            <span class="text-danger"> <i class="mdi mdi-arrow-bottom-right"></i>Accepted: @if($employee)
                {{ $employee->leave_days->where('status',"=",1)->count()}}
                 @else  
                 0 
                 @endif </span>
            <span class="text-muted">Pending:  @if($employee)
                {{ $employee->leave_days->where('status',"=",2)->count()}}
                 @else  
                 0 
                 @endif</span>
        </div>
                        </div>
                    </div>
                  </div>

                    <!--End Leave Status--> 

            </div>

    





<div class="row">
   

<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col mt-0">
                                    <h5 class="card-title">Salary Advance</h5>
                                </div>

                                <div class="col-auto">
                                    <div class="stat text-primary">
                                    <i class="fas fa-money-bill-wave-alt"></i>
                                        
                                        </div>
                                </div>
                            </div>
                            <h4 class="mt-1 mb-3" style="font-weight: bold;">
                            
                            <a style="color:black" href="{{route('employees.kyc_cashadvance_details_view')}}">Get a salary advance</a>											
                        
                        
                        </h4>
                            <div class="mb-0">
                               <span class="text-muted">Apply</span>
                            </div>
                        </div>
                    </div>
                </div>



<!-- Salary adavance status -->    

<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col mt-0">
                                    <h5 class="card-title">Salary Advance Status</h5>
                                </div>

                                <div class="col-auto">
                                    <div class="stat text-primary">
                                    <i class="fa fa-money-bill"></i>
                                    </div>
                                </div>
                            </div>
                            <h4 class="mt-1 mb-3" style="font-weight: bold;"><a style="color:black" href="">Active:@if($employee)
                                {{ $employee->cashAdvances->where('loan_status',"=",1)->count() }}
                                 @else  
                                 0 
                                 @endif </a></h4>
                            <div class="mb-0">
                                <span class="text-success"><i class="mdi mdi-arrow-bottom-right"></i>Pending: @if($employee)
                                    {{ $employee->cashAdvances->where('loan_status',"=",2)->count() }}
                                     @else  
                                     0 
                                     @endif</span>
                                <span class="text-muted">Balance:  @if($employee)
                                    ZMW {{ $employee->cashAdvances->where('loan_status',"=",1)->sum('rate_amount') - $employee->cashAdvances->where('loan_status',"=",1)->sum('total_repayments') }}
                                     @else  
                                     0 
                                     @endif</span>
                            </div>
                        </div>
                    </div>
                    </div>
                  



<!--End salary advance status-->
</div>

                


<div class="row">
<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                            <div class="col mt-0">
                                    <h5 class="card-title">Overtime</h5>
                                </div>

                                <div class="col-auto">
                                    <div class="stat text-primary">
                                        <i class="fa fa-clock-o"></i>
                                    </div>
                                </div>
                            </div>
                            <h4 class="mt-1 mb-3" style="font-weight: bold;"><a style="color:black" href="{{route('employees.overtime_details_view')}}">Work overtime</a></h4>
                            <div class="mb-0">
                                <span class="text-danger"> <i  class="mdi mdi-arrow-bottom-right"></i>Worked overtime</span>
                                <span class="text-muted">Apply</span>
                            </div>
                        </div>
                    </div>
                </div>




<!--overtime status-->
                    <div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                            <div class="col mt-0">
                                    <h5 class="card-title">Overtime</h5>
                                </div>

                                <div class="col-auto">
                                    <div class="stat text-primary">
                                        <i class="fa fa-clock-o"></i>
                                    </div>
                                </div>
                            </div>
                            <h4>Overtime Status</h4>
                            <div class="mb-0">
                                <span class="text-danger"> <i class="mdi mdi-arrow-bottom-right"></i>Total:  @if($employee)
                                    {{ $employee->overtimes->where('status',"=",1)->count()}}
                                     @else  
                                     0 
                                     @endif </span>
                                <span class="text-muted">Pending:  @if($employee)
                                    {{ $employee->overtimes->where('status',"=",2)->count()}}
                                     @else  
                                     0 
                                     @endif </span>
                            </div>                 
                        </div>
                    </div> 
                  </div> 
                  <!--End overtime status--> 
</div>






<!--End Paid Plan-->
@endif




                  <!--Leave days here-->                  
                




               </div>          
        


<!--End Statuses-->


</main>
<hr>



      @include('employees/footer')


@endif
<!--Employee Dashboard Ends here-->