@extends('admin.layout.app')

@section('title') Dashboard @endsection

@section('css')
<style type="text/css">

</style>
@endsection

@section('content')

<div class="page-header">
  <div class="row align-items-end">
   <div class="col-lg-8">
    <div class="page-header-title">
    {!! QrCode::size(50)->generate(config('app.url')."/employee_attendance"); !!}
     <div class="d-inline">
      <h5>Dashboard</h5>
     
   
       <span>Dashboard for the HR</span>
      <br>
    </div>
   
  </div>
</div>
<div class="col-lg-4">
  <nav class="breadcrumb-container" aria-label="breadcrumb">
   <ol class="breadcrumb">
    <li class="breadcrumb-item">
     <a href="£"><i class="ik ik-home"></i></a>
   </li>
   <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
 </ol>
</nav>
</div>
</div>
</div>

<button class="btn btn-danger" id="demo"></button>
<br><br>


<h4>Setup Summary</h4>
<small style="font-style:italic">All your setup of your payroll system will appear here</small>
<p style="font-style:italic">Company ID: <strong>{{Auth::user()->security_number}}</strong></p> 

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
                        <br>
<!--Show this for the Company Main Branch-->
@if(\App\Admin::find(Auth::user()->id)->branch_name == 0)
@if(is_null(\App\Admin::find(Auth::user()->id)->latitude))
<button type="button" onclick ="return confirm('You are about to set your new company main branch  location, are you sure you want to make these changes?');" class="btn btn-info btn-lg btn-block"><a style="color:white" href="{{route('admin.pin_company_location')}}"><i class="fa fa-map-marker"></i>PIN {{Auth::user()->username}} LOCATION</a></button>
@else
<button type="button" onclick ="return confirm('You are about to update your new company main branch location, are you sure you want to make these changes?');" class="btn btn-info btn-lg btn-block"><a style="color:white" href="{{route('admin.pin_company_location')}}"><i class="fa fa-map-marker"></i>PIN {{Auth::user()->username}} LOCATION</a></button>
@endif
@endif
<!--End Showing for the Company Main Branch-->
<br> 
<br><br>


@php 

$branch_location = \App\Branches::find(Auth::user()->branch_name);

@endphp

<!--If the Branch Exists-->
@if($branch_location)

<!--Check the Branch Co-ordinates Since the Branch Exists-->
@if(is_null(\App\Branches::find(Auth::user()->branch_name)->latitude))
<button type="button" onclick ="return confirm('You are about to set your new company branch  location, are you sure you want to make these changes?');" class="btn btn-info btn-lg btn-block"><a style="color:white" href="{{route('admin.pin_branch_location')}}"><i class="fa fa-map-marker"></i>PIN {{strtoupper($branch_location->branch_name)}} LOCATION</a></button>
@else
<button type="button" onclick ="return confirm('You are about to update your new company branch location, are you sure you want to make these changes?');" class="btn btn-info btn-lg btn-block"><a style="color:white" href="{{route('admin.pin_branch_location')}}"><i class="fa fa-map-marker"></i>PIN {{strtoupper($branch_location->branch_name)}} LOCATION</a></button>
@endif
@endif
<br><br> 






@include('admin/dashboard/flowchart')
<!--End Step progress bar here-->  
<br><br>
<!-- 

<img src="{{asset('flowcharts/flowchart.JPG')}}" alt="Setup Structure" style="width: 100%;"/>


End Company Flow Chart Here-->
<br><br>
<hr>



@if(Auth::user()->organogram==0)
<button type="button" class="btn btn-secondary btn-lg btn-block"><a style="color:white" href="javacsript:void()">System Analytics</a></button>
@else
<button type="button" class="btn btn-success btn-lg btn-block">System Analytics</button>
@endif
<br>





     <div class="row ">
    <div class="col-6 cursure-pointer">
    {!! $chartPie->container() !!}
 
 <script src="{{ $chartPie->cdn() }}"></script>

 {{ $chartPie->script() }}
</div>





<div class="col-6 cursure-pointer">
{!! $chartAllowances->container() !!}
 
 <script src="{{ $chartPie->cdn() }}"></script>

 {{ $chartAllowances->script() }}
</div>


</div>





<hr>

<!--Second row--> 
<h4>Payroll Summary for {{date('Y')}}</h4>
<small style="font-style:italic">All your payroll analytics will appear here</small>
<br><br>

<div class="row ">
    <div class="col-6 cursure-pointer">
    {!! $chartNet->container() !!}
 
 <script src="{{ $chartNet->cdn() }}"></script>

 {{ $chartNet->script() }}
</div>





<div class="col-6 cursure-pointer">
{!! $chartStat->container() !!}
 
 <script src="{{ $chartStat->cdn() }}"></script>

 {{ $chartStat->script() }}
</div>


</div>









    

@endsection

@section('js')
<script type="text/javascript">

</script>
@endsection