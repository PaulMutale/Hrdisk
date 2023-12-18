@include('employees/menu_header') 
<div class="main-panel shadow p-3 mb-5 bg-white rounded">
          <div class="content-wrapper">

<!-- Employee Category-->
  
<div class="form-group">
<h3>Employee Attendance</h3>
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
    
<div class="shadow p-3 mb-5 bg-white rounded">
<form method="post" action="{{route('employees.sign_in_submit')}}">
  @csrf

  
  
<div class="form-group">
    <label for="employeeName">Employee Name</label>
    <input type="text" name="employee_name" value="{{Auth::guard('Employees')->user()->first_name}} {{Auth::guard('Employees')->user()->last_name}}" class="form-control" readonly>
  </div>

 
  <div class="form-group">
    <label for="loan_amount">Employee ID</label>
    <input type="text" name="employee_id" value="{{$employee_id}}"  class="form-control"  readonly>
  
  </div>

  
  <div class="form-group">
    <label for="exampleInputPassword1">Time In</label>
    <input type="text"  name="time_in" value="{{date('H:i:s', strtotime($time_in))}}" class="form-control"  id="installments" readonly>
    
  </div>
  
  <div class="form-group">
    <label for="exampleInputPassword1">Date</label>
    <input type="text" class="form-control" name="date" value="{{$current_date}}"  id="total" readonly>
  </div>

  <div class="form-group">
    <label for="exampleInputPassword1">Distance to Office</label>
    <input type="text" class="form-control" name="distance" value="{{ $distance }}"  id="total" readonly>
  <small> Great you can login now, you are within the company premises </small>  
</div>

  <div>
           <iframe  src="https://maps.google.com/maps?q={{$latitude}},{{$longitude}}&z=15&output=embed" width="100%" height="250" frameborder="0" style="border:0"></iframe>  
  </div>

  
 
  <button type="submit" class="btn btn-primary">Check In</button>

</form>
</div>
</div>
<!--End KYC Forms-->



@include('employees/footer')