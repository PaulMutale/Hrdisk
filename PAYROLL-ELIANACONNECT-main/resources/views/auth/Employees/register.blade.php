@extends('admin.layout.auth')

@section('title') Register | E-Systems Employees  @endsection

@section('css')
<style type="text/css">
    
</style>
@endsection

@section('content')

<div class="authentication-form mx-auto">
    <center>
    <div>
        <h2><b>E<font color="#f05138">.Systems</font></b></h2>
    </div>
    </center>
    <hr>
    <h3>Sign Up to E-Systems (Employee)</h3>
    
    @if($errors->any())
    <div class="alert bg-danger text-light alert-dismissible fade show" role="alert">
        @foreach ($errors->all() as $error)
            <span>{{ $error }}</span>
        @endforeach
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <i class="ik ik-x"></i>
        </button>
    </div>
    @endif

   
    
    <form action="{{ route('employee.register') }}" method="post">
        @method('POST')
        @csrf
        <div class="form-group">
            <input type="text" name="employee_name" value="{{ old('employee_name') }}" class="form-control" placeholder="Employee Name" required="">
            <i class="ik ik-user"></i>
        </div>
        <div class="form-group">
            <input type="number" name="employee_number" value="{{ old('employee_phone_number') }}" class="form-control" placeholder="Employee Phone Number" required="">
            <i class="fas fa-phone"></i>
        </div>
        <div class="form-group">
            <input type="text" name="employee_email" value="{{ old('employee_email') }}" class="form-control" placeholder="Employee Email" required="">
            <i class="fa fa-envelope"></i>
        </div>
        <div class="form-group">
            <input type="password" name="password" class="form-control" placeholder="Password" required="">
            <i class="ik ik-lock"></i>
        </div>
        <div class="form-group">
            <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password" required="">
            <i class="ik ik-lock"></i>
        </div>
        <div class="row">
            <div class="col text-left">
                <label class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="item_checkbox" name="remember_token" value="option1">
                    
                </label>
            </div>
        </div>
        <div class="sign-btn text-center">
            <button class="btn btn-theme" type="submit">Sign Up</button>
        </div>
    </form>
</div>


@endsection

@section('js')
<script type="text/javascript">
    
</script>
@endsection