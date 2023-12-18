@extends('admin.layout.app')

@section('title') Profile ({{ $user['username'] }}) - Admin Profile @endsection

@section('css')
<style type="text/css">

</style>
@endsection

@section('content')

<div class="page-header">
  <div class="row align-items-end">
     <div class="col-lg-8">
        <div class="page-header-title">
           <i class="ik user ik-user bg-blue"></i>
           <div class="d-inline">
              <h5>Profile</h5>
              <span>Here you can view and edit your profile details.</span>
          </div>
      </div>
  </div>
  <div class="col-lg-4">
    <nav class="breadcrumb-container" aria-label="breadcrumb">
       <ol class="breadcrumb">
          <li class="breadcrumb-item">
             <a href="{{ $user['name'] }}"><i class="ik ik-home"></i></a>
         </li>
         <li class="breadcrumb-item">
             <a href="#">Profile</a>
         </li>
         <li class="breadcrumb-item active" aria-current="page">{{ $user['username'] }}</li>
     </ol>
 </nav>
</div>
</div>
</div>

<div class="row">
    <div class="col-lg-4 col-md-5">
        <div class="card new-cust-card">
            <div class="card-body">
                <div class="text-center"> 
                   
                @if(!empty(Auth::user()->principle_passport_photo))
                <img src="{{asset('LOGOS_UPLOADS/'.Auth::user()->principle_passport_photo)}}" class="rounded-circle" width="150">
                           

@else

<img src="https://eu.ui-avatars.com/api/?name={{Auth::user()->username}}" class="rounded-circle" width="150">
                              
           @endif      
                    <h4 class="card-title mt-10">{{ $user['name'] }}</h4>
                    <p class="text-dark font-weight-bold">{{ $user['username'] }}</p>
                    <p class="text-muted">Super Admin</p>
                   @if(Auth::user()->branch_name == 0)
                  <p class="text-muted">{{Auth::user()->username}}</p>
                  <p class="text-muted">{{Auth::user()->username}} Latitude : {{Auth::user()->latitude}}</p>
                  <p class="text-muted">{{Auth::user()->username}} Longitude : {{Auth::user()->longitude}}</p>
                  @else
                  
                  @php
                  $branch_name = \App\Branches::find(Auth::user()->branch_name);                  
                  @endphp
                  
                  @if($branch_name)
                  <p class="text-muted">{{$branch_name->branch_name}}</p>
                  <p class="text-muted">{{$branch_name->branch_location}}</p>
                  <p class="text-muted">{{$branch_name->branch_name}} Latitude : {{$branch_name->latitude}}</p>
                  <p class="text-muted">{{$branch_name->branch_name}} Longitude : {{$branch_name->longitude}}</p> 
                  @endif
                  @endif
                </div>
            </div>
          
          
   
     @if(Auth::user()->branch_name == 0)   
          <!--
     <div>
     <iframe  src="https://maps.google.com/maps?q={{Auth::user()->latitude}},{{Auth::user()->longitude}}&z=15&output=embed" width="100%" height="500px" frameborder="0" style="border:0"></iframe>          
  
  </div>
-->
@else

                  @php
                  $branch_name = \App\Branches::find(Auth::user()->branch_name);                  
                  @endphp
                  
                  @if($branch_name)
<!--
<div>
     <iframe  src="https://maps.google.com/maps?q={{$branch_name->latitude}},{{$branch_name->longitude}}&z=15&output=embed" width="100%" height="500px" frameborder="0" style="border:0"></iframe>          
  
  </div>
-->
  @endif
          @endif

  <br>      
          
          
          
  
          
          
          
          
        </div>
    </div>
    <div class="col-lg-8 col-md-7">
        <div class="card">
            <ul class="nav nav-pills custom-pills" id="pills-tab" role="tablist">

                <li class="nav-item">
                    <a class="nav-link active" id="pills-setting-tab" data-toggle="pill" href="#previous-month" role="tab" aria-controls="pills-setting" aria-selected="false">Profile</a>
                </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">

                <div class="tab-pane fade active show" id="previous-month" role="tabpanel" aria-labelledby="pills-setting-tab">
                    <div class="card-body">
                        
                        @if($errors->any())
                        <div class="alert {{ session()->get('bgcolor') }} text-light alert-dismissible fade show" role="alert">
                            @foreach ($errors->all() as $error)
                            <span>{{ $error }}</span>
                            @endforeach
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <i class="ik ik-x"></i>
                            </button>
                        </div>

                        @endif

                        

                        <form class="form-horizontal" method="post" action="{{ $form_url }}" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" placeholder="username" class="form-control" name="username" id="username" value="{{ $user['username'] }}">
                            </div>

                            <div class="form-group">
                                <label for="username">Company Address</label>
                                <input type="text" placeholder="Company Name" class="form-control" name="company_address" id="username" value="{{ $user['company_address'] }}">
                            </div>


                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" placeholder="johnathan@admin.com" class="form-control" id="email" value="{{ $user['email'] }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="email">Phone</label>
                                <input type="number" placeholder="0977..." class="form-control" name="phone" id="phone" value="{{ $user['phone'] }}" >
                            </div>
                            <div class="form-group">
                                <label for="airtelIC_Number">Airtel Bulk Payments IC Number</label>
                                <input type="text" name="airtel_bulk_payments_ic_number" placeholder="IC Number" class="form-control" id="email" value="{{ $user['airtel_bulk_payments_ic_number'] }}" >
                                <span class="text-danger">*Optional unless you want to pay your employees via Airtel Money Bulk Payments</span>
                            </div>

                            <div class="form-group">
                                <label for="new_password">Company Logo</label>
                                <input type="file" class="form-control" name="company_logo" placeholder="Company Logo">
                                <span class="text-danger">*Optional</span>
                            </div>

                            <div class="form-group">
                                <label for="password">Current Password</label>
                                <input type="password" class="form-control" name="password" id="password">
                                <span class="text-muted">*Please Enter current Password to save your Profile.</span>
                            </div>

                            <div class="form-group">
                                <label for="new_password">New Password</label>
                                <input type="password" class="form-control" name="new_password" id="new_password" placeholder="New Password (*if you want to change your password.)">
                                <span class="text-danger">*Not Required, If you want to change your password then enter New Password Only.</span>
                            </div>

                            <button class="btn btn-success" type="submit">Update Profile</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')
<script type="text/javascript">

</script>
@endsection