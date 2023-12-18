@extends('admin.layout.auth')

@section('title') Sign-IN | Sign-Out | E-System Employees  @endsection

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
    <h3>Sign In - Sign Out</h3>
    <p>Enter Email</p>

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

    <form action="{{ route('qrcode_attendance') }}" method="post">
        @method('POST')
        @csrf
        <div class="form-group">
            <input type="email" name="email" class="form-control" placeholder="Email" required="">
            <i class="ik ik-user"></i>
        </div>
       

        </div>
        <div class="sign-btn text-center">
            <button class="btn btn-theme" type="submit">Submit</button>
        </div>
    </form>
</div>


@endsection

@section('js')
<script type="text/javascript">
    
</script>
@endsection