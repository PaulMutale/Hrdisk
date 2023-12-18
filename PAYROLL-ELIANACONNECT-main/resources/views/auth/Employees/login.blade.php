@extends('admin.layout.auth')

@section('title') Login | E-System Employees  @endsection

@section('css')
<style type="text/css">
    
</style>
@endsection

@section('content')

<div class="authentication-form mx-auto">
    <center>
    <div>
        
         <img src="{{asset('landing_assets/img/logo1.PNG')}}" alt="E-SYSTEMS" class="img-fluid" style="width:100px; height:100px; border-radius:100%">
    </div>
</center>
<hr>
    <h3>Sign In to E-Systems</h3>
    <p>Employee Portal</p>

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

    <form action="{{ route('employee.login') }}" method="post">
        @method('POST')
        @csrf
        <div class="form-group">
            <input type="email" name="email" class="form-control" placeholder="Email" required="">
            <i class="ik ik-user"></i>
        </div>
        <div class="form-group">
            <input type="number" name="security_number" class="form-control" placeholder="Company ID" required="">
            <i class="ik ik-user"></i>
        </div>
        <div class="form-group">
            <input type="password" name="password" class="form-control" placeholder="Password" required="">
            <i class="ik ik-lock"></i>
        </div>
        <input type="hidden" name="status" value="0" class="form-control" >
        <div class="row">
            <div class="col text-left">
                <label class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="item_checkbox" name="remember_token" value="option1">
                    <span class="custom-control-label">&nbsp;Remember Me</span>
                </label>
            </div>
<!--
            <div class="col text-right">
            @if (Route::has('password.request'))
<a class="btn btn-link" href="javascript:void()">
    {{ __('Forgot Your Password? See your HR') }}
</a>
@endif
            </div>
-->
        </div>
        <div class="sign-btn text-center">
            <button class="btn btn-theme" type="submit">Sign In</button>
        </div>
    </form>
</div>


@endsection

@section('js')
<script type="text/javascript">
    
</script>
@endsection