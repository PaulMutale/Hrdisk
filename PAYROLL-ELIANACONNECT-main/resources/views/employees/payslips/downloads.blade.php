@include('employees/menu_header') 

<div class="main-panel">
          <div class="content-wrapper">


<h4>Download Payslips</h4>
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
<form action="{{route('employees.payslip_details_submit')}}" method="POST" id="createEmployee">
                    @csrf
                   
                      <div class="col-md-4 col-lg-4 col-sm-12">
                        <div class="form-group">
                          <label for="gender">Year </label><small class="text-danger">*</small>
                          <select class="form-control" id="gender" name="gender">
                            <option value="" selected value disabled>-- Select Year --</option>
                            <option value="2022">2022</option>
                            
                            
                          </select>
                          <small class="text-danger err" id="year-err"></small>
                        </div>
                      </div>
                      <div class="col-md-4 col-lg-4 col-sm-12">
                        <div class="form-group">
                          <label for="gender">Month </label><small class="text-danger">*</small>
                          <select class="form-control" id="gender" name="gender">
                            <option value="" selected value disabled>-- Select Month --</option>
                            <option value="January">January</option>
                            <option value="February">February</option>
                            <option value="March">March</option>
                            <option value="April">April</option>
                            <option value="May">May</option>
                            <option value="June">June</option>

                            <option value="July">July</option>
                            <option value="August">August</option>
                            <option value="September">September</option>
                            <option value="October">October</option>
                            <option value="November">November</option>
                            <option value="December">December</option>
                          
                            
                            
                          </select>
                          <small class="text-danger err" id="month-err"></small>
                        </div>
                      </div>

                      <button type="submit" class="btn btn-primary">Download <i class="fa fa-download mdi-24px float-right"></i></button>  
                </form>
           <br><br>







@include('employees/footer')