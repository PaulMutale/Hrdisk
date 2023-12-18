@extends('admin.layout.app')

@section('title') Invite Employee @endsection

@section('css')

<style type="text/css">
    .overflow-visible{
        overflow: visible !important;
    }
    .modal-sm{
      width: auto;
      max-width: 356px !important;
    }
    .select2-container--default {
      display: block;
      width: auto !important;
    }
</style>
@endsection

@section('content')

<div class="page-header">
  <div class="row align-items-end">
     <div class="col-lg-8">
        <div class="page-header-title">
           <i class="ik ik-users bg-blue"></i>
           <div class="d-inline">
              <h5>Employees</h5>
              <span>Invite Employee, Please fill all field correctly.</span>
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
             <a href="{{ route('admin.employee.index') }}">Employees</a>
         </li>
         <li class="breadcrumb-item active" aria-current="page">Invite</li>
     </ol>
 </nav>
</div>
</div>
</div>

<div class="row">
    <div class="col-md-8 col-sm-12 col-xl-8 offset-md-2 offset-xl-2">

        <div class="widget overflow-visible">
            <div class="progress progress-sm progress-hi-3 hidden">
                <div class="progress-bar bg-info" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>
            </div>
            <div class="widget-body">
                <div class="overlay hidden">
                    <i class="ik ik-refresh-ccw loading"></i>
                    <span class="overlay-text">Sending Invitation via email...</span>
                </div>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="state">
                        <h5 class="text-secondary">Invite Employee</h5>
                    </div>
                </div>

                <form action="{{ $form_store }}" method="POST" enctype="multipart/form-data" id="createEmployee">
                    @csrf
                    <div class="row">
                      <div class="col-md-6 col-lg-6 col-sm-12">
                       <div class="form-group">
                        <label for="first_name">First Name</label><small class="text-danger">*</small>
                        <input type="text" name="first_name" class="form-control" id="first_name" placeholder="John" autocomplete="off">
                        <small class="text-danger err" id="first_name-err"></small>
                      </div>
                      </div>
                      <div class="col-md-6 col-lg-6 col-sm-12">
                       <div class="form-group">
                        <label for="last_name">Last Name</label><small class="text-danger">*</small>
                        <input type="text" name="last_name" class="form-control" id="last_name" placeholder="Duo" autocomplete="off">
                        <small class="text-danger err" id="last_name-err"></small>
                      </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6 col-lg-6 col-sm-12">
                        <div class="form-group">
                          <label for="email">Email</label><small class="text-danger">*</small>
                          <input type="email" name="email" class="form-control" id="email" placeholder="john@example.com" autocomplete="off">
                          <input type="hidden" name="username">
                          <small class="text-danger err" id="email-err"></small>
                        </div>
                      </div>
                    @php 
$branches = \App\Branches::where('company_id',"=",Auth::user()->security_number)->get();
@endphp
                      <div class="col-md-6 col-lg-6 col-sm-12">
                       <div class="form-group">
                        <label for="Branch Name">Branch</label><small class="text-danger">*</small>
                        <select class="form-control" name="branch_name" >
                        <option value=0>{{ Auth::user()->username }}</option> 
                          @foreach($branches as $branch)                          
                            <option value="{{ $branch->branch_id }}">{{ $branch->branch_name }}</option>                            
                          @endforeach
                        </select>
                        <small class="text-danger err" id="position_id-err"></small>
                      
                      
                      </div>
                      </div>                   
                      
                    </div>
                  
                  
                  
                    <div class="row">
                      <div class="col-md-4 col-lg-4 col-sm-12">
                       
                      </div>
                      
                     
                    </div>
                    <div class="row">
                      <div class="col-md-6 col-lg-6 col-sm-12">
                       <div class="form-group">
                        <label for="position_id">Position</label><small class="text-danger">*</small>
                        <select class="form-control" name="position_id" id="position_id">
                          @foreach($positions as $position)
                            <option value="{{ $position->id }}">{{ $position->title }}</option>
                          @endforeach
                        </select>
                        <small class="text-danger err" id="position_id-err"></small>
                      </div>
                      </div>
                      <div class="col-md-6 col-lg-6 col-sm-12">
                       <div class="form-group">
                        <label for="schedule_id">Schedule</label><small class="text-danger">*</small>
                        <select class="form-control" name="schedule_id" id="schedule_id">
                          @foreach($schedules as $schedule)
                            <option value="{{ $schedule->id }}">{{ $schedule->time_in.'-'.$schedule->time_out }}</option>
                          @endforeach
                        </select>
                        <small class="text-danger err" id="schedule_id-err"></small>
                      </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6 col-lg-6 col-sm-12">
                       <div class="form-group">
                       <label for="Rate Per Hour">Rate Per Hour</label><small class="text-danger">*</small>
                       <select class="form-control" name="rate_per_hour" id="position_id">
                          @foreach($positions as $position)
                            <option value="{{ ($position->salary_scale * 12) / (40 * 52) }}"> For {{ $position->title }} -  ZMW {{ number_format(($position->salary_scale * 12) / (40 * 52),2) }}</option>
                          @endforeach
                        </select>
                        <small class="text-danger err" id="rate_per_hour-err">It's important for Payscal calculation.</small>
                      </div>
                      </div>
                      <div class="col-md-6 col-lg-6 col-sm-12">
                       <div class="form-group">
                       <label for="Salary">Salary</label><small class="text-danger">*</small>
                        <select class="form-control" name="salary" id="position_id">
                          @foreach($positions as $position)
                            <option value="{{ $position->salary_scale  }}"> For {{ ($position->title) }} - ZMW {{ number_format($position->salary_scale,2) }}</option>
                          @endforeach
                        </select>
                        <small class="text-danger err" id="salary-err">It's important for Payscal calculation.</small>
                      </div>
                      </div>
                    </div>
                  
                  <div class="row">

<div class="col-md-6 col-lg-6 col-sm-12">
    <div class="form-group">
      <label for="Start Date">Joining Date</label><small class="text-danger">*</small>
      <input type="text" class="form-control datetimepicker-input" name="employee_start_date" id="start_date" data-toggle="datetimepicker" data-target="#start_date" autocomplete="off">
      <small class="text-danger err" id="employee_start_date-err"></small>
    </div>
  </div>

  <div class="col-md-6 col-lg-6 col-sm-12">
    <div class="form-group">
      <label for="End Date">End Date</label><small class="text-danger"></small>
      <input type="text" class="form-control datetimepicker-input" name="employee_end_date" id="end_date" data-toggle="datetimepicker" data-target="#end_date" autocomplete="off" >
      <small class="text-danger err" id="employee_end_date-err"></small>
    </div>
  </div>
                  </div>
                  
                  
                  
                  
                  
                  
                  
                    <div class="row">
                      
                      <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="form-group">
                          <label for="remark">Work Description</label><small class="text-danger">*</small>
                          <textarea class="form-control" id="remark" name="remark" rows="3" required></textarea>
                        </div>
                      </div>
                    </div>


                    <div class="row">
                     
                      <div class="col-md-6 col-lg-6 col-sm-12">
                       <div class="form-group">
                        <label for="last_name">Company Identity Number</label><small class="text-secondary">(Company ID)</small>
                        <input type="number" name="security_number" value="{{Auth::user()->security_number}}" class="form-control" id="ecurity_number" readonly>
                        
                      </div>
                      </div>
                    </div>



                    <div class="row">
                      <div class="col-md-6 col-lg-6 col-sm-12">
                        <div class="form-group" style="display: none;">
                          <label for="is_active">Put on Payroll </label>
                          <select class="form-control" id="is_active" name="is_active" value=0>
                          <option value="0">Denie</option>
                          <option value="1">Accept</option>
                          </select>
                        </div>
                            <button type="submit" class="btn btn-primary"><i class="ik save ik-save"></i>Submit</button>
                            <a href="{{ route('admin.employee.index') }}" class="btn btn-light"><i class="ik arrow-left ik-arrow-left"></i> Go Back</a>
                      </div>
                      <!--
                      <div class="col-md-6 col-lg-6 col-sm-12" id="add-avatar-div">
                        <div class="form-group">
                          <label for="avatar">Upload Profile Picture</label><small class="text-secondary">(Optional)</small>
                          <label for="avatar" class="btn btn-outline-danger d-block btn-block mb-0"><i class="ik ik-image"></i> Attach Document</label>
                          <input type="file" name="avatar" class="image hidden" id="avatar">
                          <small class="text-danger err" id="media-err">*Please add pixel perfect avatar of Employee.</small> 
                        </div>
                      </div>
  -->
                      <div class="col-md-6 col-lg-6 col-sm-12 hidden" id="show-avatar-div">
                        <div class="form-group my-auto">
                          <a href="#" class="text-danger float-right" data-remove="" id="remove-avatar-profile"><i class="ik ik-x-circle"></i></a>
                          <img src="{{ asset('admin_assets/avatars/merchant/thumb/male.png') }}" class="circle-temp" id="avatar-profile">
                        </div>
                      </div>
                    </div>





                    
                </form>
            </div>

        </div>
    </div>
</div>

<!--Avatar model-->
<div class="modal" id="AvatarModel">
  <div class="modal-dialog modal-dialog-centered modal-sm">
    <div class="modal-content">
      <!-- Modal body -->
      <div class="modal-body">
        <div class="img-container">
          <div class="row">
            <div class="col-md-12 col-sm-12 col-lg-12" id="avatar-preview">
              
            </div>
          </div>
        </div>
        <div class="mt-2">
          <div class="row">
            <div class="col-md-6 col-lg-6 col-sm-12">
              <button type="button" class="btn btn-block btn-outline-secondary" data-dismiss="modal"><i class="ik x-circle ik-x-circle"></i> Close</button>
            </div>
            <div class="col-md-6 col-lg-6 col-sm-12">
              <button type="button" class="btn btn-block btn-dark" id="crop-nd-save"><i class="ik ik-crop"></i> Crop & Save</button>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>

@endsection

@section('js')

<script type="text/javascript">

$uploadCrop = $('#avatar-preview').croppie({
    enableExif: true,
    viewport: {
        width: 312,
        height: 312,
        type: 'circle'
    },
    boundary: {
        width: 320,
        height: 320
    },
});

$model = $("#AvatarModel");


$(document).ready(function($) {
  $("#schedule_id,#position_id").select2();
  
  $('#birthdate').datetimepicker({
    format: 'LL'
  });

  $("#createEmployee").submit(function(event){
    event.preventDefault();
    createForm("#createEmployee");
  }); 

  $('#avatar').on('change', function () { 
    var reader = new FileReader();
    reader.onload = function (e) {
      $uploadCrop.croppie('bind', {
        url: e.target.result
      })
    }
    reader.readAsDataURL(this.files[0]);
    $model.modal('show');
  });

  //crop and save image
  $('#crop-nd-save').on('click', function (ev) {
    $uploadCrop.croppie('result', {
      type: 'canvas',
      size: 'viewport',
      circle:false
    }).then(function (resp) {
      $.ajax({
        url: "{{ route('admin.storeMediaBase64') }}",
        type: "POST",
        data: {"file":resp},
        headers: {
          'X-CSRF-TOKEN': "{{ csrf_token() }}"
        },
        beforeSend:function(){
          $("button").prop('disabled',true);
        },
        success: function (response) {
          $('form#createEmployee').append('<input type="hidden" name="media" value="' + response.name + '">');
          $("#avatar-profile").prop('src', response.profileUrl); // avatar profile show 
          $("#remove-avatar-profile").prop('href', response.removeProfileUrl);//remove button
          $("#add-avatar-div").addClass('hidden');
          $("#show-avatar-div").removeClass('hidden');
          $model.modal('hide'); // model close
        },
        complete:function(){
          $("button").prop('disabled',false);
        }
      });
    });
  });

  //remove current saved image
  $("#remove-avatar-profile").on('click',function(e){
    e.preventDefault();
    var fireUrl = $(this).prop('href'); 
    $.ajax({
        url: fireUrl,
        type: "POST",
        headers: {
          'X-CSRF-TOKEN': "{{ csrf_token() }}"
        },
        beforeSend:function(){
          $("button").prop('disabled',true);
        },
        success: function (response) {
          $('<input type="hidden" name="media">').remove();
          $("#show-avatar-div").addClass('hidden');
          $("#add-avatar-div").removeClass('hidden');
        },
        complete:function(){
          $("button").prop('disabled',false);
        }
      });
  });

});
</script>
@endsection