@include('employees/menu_header') 

<div class="main-panel">
          <div class="content-wrapper">


<h4>Change Password</h4>
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



<form method="post" action="{{route('employees.change_password_submit',encrypt(Auth::guard('Employees')->user()->id))}}">
  @csrf
  <div class="form-group required">
    <label for="Medical Forms">Old Password</label><small class="text-danger">*</small>
    <input type="text" name="old_password" class="form-control" required>
    
  </div>

  <div class="form-group required">
    <label for="Medical Forms">New Password</label><small class="text-danger">*</small>
    <input type="text" name="password" class="form-control" required>
    
  </div>

  <div class="form-group required">
    <label for="Medical Forms">Confirm New  Password</label><small class="text-danger">*</small>
    <input type="text" name="password_confirmation" class="form-control" required>
    
  </div>

      
    <button type="submit" class="btn btn-primary">Change Password</button>  
  </div>   
</div>
</div>
</form>






@include('employees/footer')