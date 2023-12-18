@extends('admin.layout.app')

@section('title') Payroll @endsection

@section('css')
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<style type="text/css">
    .overflow-visible{
        overflow: visible !important;
    }
    td.p-0 img.img-thumbnail{
      width: 140px;
    }
    button.h-33{
      height: 33px !important;
    }
    .divHide{
      display: none;
    }
</style>
@endsection

@section('content')

<div class="page-header">
  <div class="row align-items-end">
    <div class="col-lg-8">
      <div class="page-header-title">
        <i class="ik ik-dollar-sign bg-blue"></i>
        <div class="d-inline">
          <h5>Payroll</h5>
          
          <span>You can show and manage Payroll from here.</span>
        
        
 <!-- Checking Logo Status starts here-->    
 <br><br>       
 @if(is_null(Auth::user()->company_logo) || Auth::user()->company_logo === 'Null')
<i class="fa fa-warning" style="color:red" ></i> <button type="button" class="btn btn-danger"><a style="color:white" href="javacsript:void()"> Please Update Your Company Logo Under Profile before attempting to run the Payroll</a></button>
@else
<button type="button" class="btn btn-success">Your Company Logo has been updated successfully</button>
@endif
<br> 
          
<!-- Checking Logo status ends here-->  
        
        
        
        
          
        </div>
      </div>
    </div>
    <div class="col-lg-4">
      <nav class="breadcrumb-container" aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="{{ route('admin.dashboard') }}"><i class="ik ik-home"></i></a>
          </li>
          <li class="breadcrumb-item">
            <a href="{{ route('admin.overtime.index') }}">Payroll</a>
          </li>
          <li class="breadcrumb-item active" aria-current="page">List of Payroll</li>
        </ol>
      </nav>
    </div>
  </div>



<center>
  <!--Loading gif while sending payments reports--> 
<div class="modal-body">
      <!--LOADING MODAL https://i.gifer.com/7pld.gif--> 
     
      <div id="loadings" style="display:none">
   
   
    <h5 style="font-weight:bold; color:royalblue">Loading...</h5> 
    <br>
  <img src="https://i.gifer.com/VAyR.gif" />

</div>
<!--End Loading gifs while sending payments reports-->
</center>








  <div class="row">
    <div class="col-lg-12 col-md-12 mt-4">
      <div class="card">

        <!--Tab content-->
        <div class="loader br-4 hidden">
          <i class="ik ik-refresh-cw loading"></i>
          <span class="loader-text">Data Fetching....</span>
        </div>
        <div class="tabs_contant">
          <div class="card-header">
            <h5>List of Payroll</h5>
          </div>
          <div class="card-body">
              
          </div>
        </div>
        <!--End Tab Content-->
      </div>
    </div>
  </div>
  
</div>

<div class="row">
    <div class="col-md-12">
        <form id="deleteForm" method="post">
            @csrf
            @method('DELETE')
            <input type="submit" name="submit" class="hidden">
        </form>
    </div>
</div>

<div class="showModel">
 
</div>

@endsection

@section('js')
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script type="text/javascript">
  
$(document).ready(function() {

  // get data from serve ajax
  const getDataUrl = "{{ $get_data }}"
  getData(getDataUrl);

});




//Triger Loading Modal here



function loading() {
document.getElementById("loadings").style.display = "block";
window.setTimeout("closeModalDiv();", 3000);
}

function closeModalDiv(){
document.getElementById("loadings").style.display=" none";
}
    

//Triger Loading Modal ends here
</script>
@endsection