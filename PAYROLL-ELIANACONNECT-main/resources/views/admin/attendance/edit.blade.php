@extends('admin.layout.app')

@section('title') Edit Attendance @endsection

@section('css')
<style type="text/css">
    .overflow-visible{
        overflow: visible !important;
    }
    .modal-sm{
      width: auto;
      max-width: 356px !important;
    }
    input[data-readonly] {
  pointer-events: none;
}

</style>
@endsection

@section('content')

<div class="page-header">
  <div class="row align-items-end">
     <div class="col-lg-8">
        <div class="page-header-title">
           <i class="ik ik-check-circle bg-blue"></i>
           <div class="d-inline">
              <h5>Attendance</h5>
              <span>Approve Attendance, Please fill all field correctly.</span>
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
             <a href="{{ route('admin.overtime.index') }}">Attendance</a>
         </li>
         <li class="breadcrumb-item">
             <a href="#">Edit</a>
         </li>
         <li class="breadcrumb-item active" aria-current="page">{{ $attendance->title }}</li>
     </ol>
 </nav>
</div>
</div>
</div>

<div class="row">
    <div class="col-md-6 col-sm-12 col-xl-6 offset-md-3 offset-xl-3">

        <div class="widget overflow-visible">
            <div class="progress progress-sm progress-hi-3 hidden">
                <div class="progress-bar bg-info" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>
            </div>
            <div class="widget-body">
                <div class="overlay hidden">
                    <i class="ik ik-refresh-ccw loading"></i>
                    <span class="overlay-text">Attendance Updating...</span>
                </div>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="state">
                        <h5 class="text-secondary">Edit Attendance</h5>
                    </div>
                </div>

                <form action="{{ $form_update }}" method="POST" enctype="multipart/form-data" id="editAttendance">
                    @method('PUT')
                    @csrf
                    <div class="row">
                      <div class="col-md-8 col-lg-8 col-sm-12">
                       <div class="form-group">
                        <label for="employee_id">Employee</label><small class="text-danger">*</small>
                        <select class="form-control" name="employee_id" id="employee_id" required data-readonly>
                          @foreach($employees as $employee)
                          <option value="{{ $employee->id }}"
                            @if($employee->id == $attendance->employee_id)
                            selected
                            @endif
                            >{{ $employee->first_name." ".$employee->last_name." (#".$employee->employee_id.")" }}</option>
                          @endforeach
                        </select>
                        <small class="text-danger err" id="employee_id-err"></small>
                      </div>
                    </div>
                    <div class="col-md-4 col-lg-4 col-sm-12">
                      <div class="form-group">
                        <label for="date">Date</label><small class="text-danger">*</small>
                        <input type="text" class="form-control datetimepicker-input" name="date" id="date" data-toggle="datetimepicker" data-target="#date" autocomplete="off" data-value="{{ $attendance->date }}" required data-readonly>
                        <small class="text-danger err" id="date-err"></small>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6 col-lg-6 col-sm-12">
                      <div class="form-group">
                        <label for="time_in">Time In</label><small class="text-danger">*</small>
                        <input type="text" class="form-control datetimepicker-input" id="time_in" data-toggle="datetimepicker" data-target="#time_in" name="time_in" data-value="{{ $attendance->time_in }}" required data-readonly>
                        <small class="text-danger err" id="time_in-err"></small>
                      </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-sm-12">
                      <div class="form-group">
                        <label for="time_out">Time Out</label>
                        <input type="text" class="form-control datetimepicker-input" id="time_out" data-toggle="datetimepicker" data-target="#time_out" name="time_out" data-value="{{ $attendance->time_out }}" required data-readonly>
                        <small class="text-danger err" id="time_out-err"></small>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12 col-lg-12 col-sm-12">
                      
                      <button type="submit" class="btn btn-primary"><i class="ik save ik-save"></i>Submit</button>
                      <a href="{{ route('admin.attendance.index') }}" class="btn btn-light"><i class="ik arrow-left ik-arrow-left"></i> Go Back</a>
                    </div>
                  </div>
                </form>
            </div>

        </div>
    </div>
</div>

@endsection

@section('js')

<script type="text/javascript">
$(document).ready(function($) {
  $("#employee_id").select2();
  
  let date = $("#date").data("value");
  $('#date').datetimepicker({
    defaultDate: date,
    format: 'LL',
  });

  let time_in = $("#time_in").data("value");
  let time_out = $("#time_out").data("value");
  $('#time_in').datetimepicker({
    format: 'LT',
    defaultDate: moment(time_in,"h:m A"),
  });
  $('#time_out').datetimepicker({
    format: 'LT',
    defaultDate: moment(time_out,"h:m A"),
  });

  $("#editAttendance").submit(function(event){
    event.preventDefault();
    editForm("#editAttendance");
  }); 
});
</script>
@endsection