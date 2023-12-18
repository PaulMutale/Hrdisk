@include('employees/menu_header') 

<div class="main-panel shadow p-3 mb-5 bg-white rounded">
          


<h4>Personal Details</h4>
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
<form action="{{route('employees.payroll_details_submit')}}" method="POST" enctype="multipart/form-data" id="createEmployee">
                    @csrf
                    <div class="row">
                      <div class="col-md-6 col-lg-6 col-sm-12">
                       <div class="form-group">
                        <label for="first_name">First Name</label><small class="text-danger">*</small>
                        <input type="text" name="first_name" value="{{Auth::guard('Employees')->user()->first_name}}" class="form-control" id="first_name" placeholder="John" readonly>
                        <small class="text-danger err" id="first_name-err"></small>
                      </div>
                      </div>
                      <div class="col-md-6 col-lg-6 col-sm-12">
                       <div class="form-group">
                        <label for="last_name">Last Name</label><small class="text-danger">*</small>
                        <input type="text" name="last_name" value="{{Auth::guard('Employees')->user()->last_name}}" class="form-control" id="last_name" placeholder="Duo" readonly>
                        <small class="text-danger err" id="last_name-err"></small>
                      </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12 col-lg-12 col-sm-12">
                        <div class="form-group">
                          <label for="email">Email</label><small class="text-danger">*</small>
                          <input type="email" name="email" class="form-control" id="email" value="{{Auth::guard('Employees')->user()->email}}" readonly>
                          <input type="hidden" name="username">
                          <small class="text-danger err" id="email-err"></small>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-4 col-lg-4 col-sm-12">
                      <div class="col-md-12 col-lg-12 col-sm-12">
                        <div class="form-group">
                          <label for="email">Gender</label><small class="text-danger">*</small>
                          <input type="text" name="gender" class="form-control" id="email" value="{{Auth::guard('Employees')->user()->gender}}" readonly>
                          <input type="hidden" name="username">
                          <small class="text-danger err" id="email-err"></small>
                        </div>
                      </div>
                      </div>
                      <div class="col-md-4 col-lg-4 col-sm-12">
                        <div class="form-group">
                          <label for="phone">Phone</label><small class="text-danger">*</small>
                          <input type="text" name="phone" class="form-control" id="phone" placeholder="XXXX-XXX-XXX" autocomplete="off" value="{{Auth::guard('Employees')->user()->phone}}" readonly>
                          <small class="text-danger err" id="phone-err"></small>
                        </div>
                      </div>
                      <div class="col-md-4 col-lg-4 col-sm-12">
                        <div class="form-group">
                          <label for="birthdate">Birthdate</label><small class="text-danger">*</small>
                          <input type="text" value="{{Auth::guard('Employees')->user()->birthdate}}" class="form-control" name="birthdate" readonly>
                          <small class="text-danger err" id="birthdate-err"></small>
                        </div>
                      </div>
                    </div>
                  
                  
                    <div class="row">
                      <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="form-group">
                          <label for="address">Address</label>  <small class="text-danger">*</small>
                          <textarea class="form-control" id="address" name="address" rows="3" readonly>{{Auth::guard('Employees')->user()->address}}</textarea>
                        </div>
                      </div>
                      <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="form-group">
                          <label for="remark">Work Description</label><small class="text-danger">*</small>
                          <textarea class="form-control" id="remark" name="remark" rows="3" readonly>{{Auth::guard('Employees')->user()->remark}}</textarea>
                        </div>
                      </div>
                    </div>


                    <div class="row">
                      <div class="col-md-6 col-lg-6 col-sm-12">
                       <div class="form-group">
                        <label for="first_name">Employee TPIN</label><small class="text-danger">*</small>
                        <input type="text" name="tpin" value="{{Auth::guard('Employees')->user()->tpin}}" class="form-control" id="tpin" placeholder="Enter TPIN" readonly>
                        
                      </div>
                      </div>

                      <div class="col-md-6 col-lg-6 col-sm-12">
                       <div class="form-group">
                        <label for="last_name">Company Identity Number</label><small class="text-secondary">(Company ID)</small>
                        <input type="number" value="{{Auth::guard('Employees')->user()->security_number}}" name="security_number" class="form-control" id="security_number" readonly>
                        
                      </div>
                      </div>

                    </div>



                    <div class="row">
                     

                      <div class="col-md-6 col-lg-6 col-sm-12">
                       <div class="form-group">
                        <label for="last_name">National Regsitration Card</label><small class="text-danger">*</small>
                        <input type="file" name="nrc" class="form-control" id="security_number" required>
                        
                      </div>
                      </div>
                      
                    </div>



                    <div class="row">
                     
                            <button type="submit" class="btn btn-primary">Next</button>
                            <br>
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
                     
                    </div>





                    
                </form>
           <br><br>







@include('employees/footer')