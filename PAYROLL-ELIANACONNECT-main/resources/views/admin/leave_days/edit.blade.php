@extends('admin.layout.app')

@section('title') {{ $leave_days->name }} - Approve Leave @endsection

@section('css')
<style type="text/css">
    .overflow-visible{
        overflow: visible !important;
    }
    .modal-sm{
      width: auto;
      max-width: 356px !important;
    }
</style>
@endsection

@section('content')

<div class="page-header">
  <div class="row align-items-end">
     <div class="col-lg-6">
        <div class="page-header-title">
           <i class="ik ik-at-sign bg-blue"></i>
           <div class="d-inline">
              <h5>Staff</h5>
              <span>Edit Staff, Please fill all field correctly.</span>
          </div>
      </div>
  </div>
  <div class="col-lg-6">
    <nav class="breadcrumb-container" aria-label="breadcrumb">
       <ol class="breadcrumb">
          <li class="breadcrumb-item">
             <a href="{{ route('admin.leave_days.index') }}"><i class="ik ik-home"></i></a>
         </li>
         <li class="breadcrumb-item">
             <a href="{{ route('admin.leave_days.index') }}">HR</a>
         </li>
         <li class="breadcrumb-item">
             <a href="#">Edit</a>
         </li>
         <li class="breadcrumb-item active" aria-current="page">{{ $leave_days->leave_name }}</li>
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
                    <span class="overlay-text">HR {{ $leave_days->leave_name }} Updating...</span>
                </div>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="state">
                        <h5 class="text-secondary"><i class="ik ik-at-sign"></i>{!! $leave_days->leave_name !!} Edit</h5>
                    </div>
                </div>

                <form action="{{ $form_update }}" method="POST" enctype="multipart/form-data" id="editCashadvance">
                    @method('PUT')
                    @csrf
                    <div class="row">
                      <div class="col-md-8 col-lg-8 col-sm-12">
                       <div class="form-group">
                        <label for="title">Leave Name</label><small class="text-danger">*</small>
                        <input type="text" name="leave_name" class="form-control" id="title" autocomplete="off" value="{{ $leave_days->leave_name }}">
                        <small class="text-danger err" id="title-err"></small>
                      </div>
                    </div>
                    <div class="col-md-4 col-lg-4 col-sm-12">
                      <div class="form-group">
                        <label for="date">Applied On</label><small class="text-danger">*</small>
                        <input type="text" class="form-control" id="date" value="{{ $leave_days->created_at }}" readonly>
                        <small class="text-danger err" id="date-err"></small>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12 col-lg-12 col-sm-12">
                     <div class="form-group">
                      <label for="employee_id">Employee</label><small class="text-danger">*</small>
                      <select class="form-control" name="employee_id" id="employee_id" readonly>
                        @foreach($employees as $employee)
                        <option value="{{ $employee->id }}"
                          @if($employee->id == $leave_days->employee_id)
                          selected
                          @endif
                          >{{ $employee->first_name." ".$employee->last_name." (#".$employee->employee_id.")" }}
                        </option>
                        @endforeach
                      </select>
                      <small class="text-danger err" id="employee_id-err"></small>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12 col-lg-12 col-sm-12">
                   <div class="form-group">
                    <label for="rate_amount">Current Leave</label><small class="text-danger">*</small>
                    <input type="text" name="exhausted_leaves" class="form-control" id="rate_amount" autocomplete="off" value="{{ $leave_days->exhausted_leaves }}">
                    
                  </div>
                </div>
            </div>

            <div class="row">
                  <div class="col-md-12 col-lg-12 col-sm-12">
                   <div class="form-group">
                    <label for="Remaining Leave(s)">Remaining Leave(s)</label><small class="text-danger">*</small>
                    <input type="text" name="remaining_leaves" class="form-control" id="rate_amount" autocomplete="off" value="{{ $leave_days->remaining_leaves }}">
                  
                  </div>
                </div>
            </div>


            <div class="row">
                  <div class="col-md-12 col-lg-12 col-sm-12">
                   <div class="form-group">
                    <label for="Remaining Leave(s)">Leave Duration (In Days Only)</label><small class="text-danger">*</small>
                    <input type="numeric" name="duration" value="{{$leave_days->duration}}" class="form-control" id="rate_amount" autocomplete="off" >
                  <small>important for leave amortization</small>
                  </div>
                </div>
            </div>

 <input type="hidden" name="id" value="{{$leave_days->id}}"/>


            <div class="row">
              <div class="col-md-12 col-lg-12 col-sm-12">
                <button type="submit" class="btn btn-primary"><i class="ik save ik-save"></i>Approve</button>
                <a href="{{ route('admin.leave_days.index') }}" class="btn btn-light"><i class="ik arrow-left ik-arrow-left"></i> Go Back</a>
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

  $("#editCashadvance").submit(function(event){
    event.preventDefault();
    editForm("#editCashadvance");
  }); 
});
</script>
@endsection