@include('employees/menu_header') 

<div class="main-panel">
          <div class="content-wrapper">


<h4>Apply For Leave</h4>
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
<form action="{{ $form_store }}" method="POST" enctype="multipart/form-data" id="createOvertime">
                    @csrf
                    <div class="row">
                      <div class="col-md-8 col-lg-8 col-sm-12">
                       <div class="form-group">
                        <label for="title">Title</label><small class="text-danger">*</small>
                        <input type="text" name="title" class="form-control" id="title" placeholder="Some Title or Reason for Overtime" autocomplete="off">
                        <small class="text-danger err" id="title-err"></small>
                      </div>
                      </div>
                      <div class="col-md-4 col-lg-4 col-sm-12">
                        <div class="form-group">
                          <label for="date">Date</label><small class="text-danger">*</small>
                          <input type="text" class="form-control datetimepicker-input" name="date" id="date" data-toggle="datetimepicker" data-target="#date" autocomplete="off">
                          <small class="text-danger err" id="date-err"></small>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12 col-lg-12 col-sm-12">
                       <div class="form-group">
                        <label for="employee_id">Employee</label><small class="text-danger">*</small>
                        <select class="form-control" name="employee_id" id="employee_id">
                          
                            <option value="{{Auth::guard('Employees')->user()->employee_email}}">{{Auth::guard('Employees')->user()->employee_name}}</option>
                          
                        </select>
                        <small class="text-danger err" id="employee_id-err"></small>
                      </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6 col-lg-6 col-sm-12">
                       <div class="form-group">
                        <label for="rate_amount">Rate Per Hour</label><small class="text-danger">*</small>
                        <input type="text" name="rate_amount" class="form-control" id="rate_amount" placeholder="200.00" autocomplete="off">
                        <small class="text-danger err" id="rate_amount-err">It's important for Payscal calculation.</small>
                      </div>
                      </div>
                      <div class="col-md-6 col-lg-6 col-sm-12">
                       <div class="form-group">
                        <label for="hour">Hours worked</label><small class="text-danger">*</small>
                        <select class="form-control" name="hour" id="hour">
                          <option value="1">1 Hr</option>
                          <option value="2">2 Hr</option>
                          <option value="3">3 Hr</option>
                          <option value="4">4 Hr</option>
                          <option value="5">5 Hr</option>
                          <option value="6">6 Hr</option>
                          <option value="7">7 Hr</option>
                          <option value="8">8 Hr</option>
                        </select>
                        <small class="text-danger err" id="hour-err"></small>
                      </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="form-group">
                          <label for="description">Description</label>  <small class="text-secondary">(Optional)</small>
                          <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                        </div>
                      </div>
                    </div>


                    <div class="row">
                      <div class="col-md-12 col-lg-12 col-sm-12">
                        <button type="submit" class="btn btn-primary"><i class="ik save ik-save"></i>Submit</button>
                        
                      </div>
                    </div>
                </form>
</div>







@include('employees/footer')