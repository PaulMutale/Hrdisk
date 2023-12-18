@include('employees/menu_header') 
<div class="main-panel shadow p-3 mb-5 bg-white rounded">
          



<h4>Company records of {{Auth::guard('Employees')->user()->first_name}} {{Auth::guard('Employees')->user()->last_name}}</h4>
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


<form action="{{route('employees.kyc_personal_details_submit')}}" method="POST" id="createEmployee">
                    @csrf
                    <div class="row">
                      <div class="col-md-6 col-lg-6 col-sm-12">
                       <div class="form-group">
                        <label for="first_name">First Name</label><small class="text-danger">*</small>
                        <input type="text" name="first_name" class="form-control" id="first_name" value="{{Auth::guard('Employees')->user()->first_name}}" readonly>
                        <small class="text-danger err" id="first_name-err"></small>
                      </div>
                      </div>
                      <div class="col-md-6 col-lg-6 col-sm-12">
                       <div class="form-group">
                        <label for="last_name">Last Name</label><small class="text-danger">*</small>
                        <input type="text" name="last_name" class="form-control" id="last_name" value="{{Auth::guard('Employees')->user()->last_name}}" readonly>
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
                      <div class="form-group">
                          <label for="gender">Gender </label><small class="text-danger">*</small>
                          <select class="form-control" id="gender" name="gender" required>
                            <option selected value disabled>choose</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            <option value="Other">Other</option>
                          </select>
                          <small class="text-danger err" id="gender-err"></small>
                        </div>
                      
                      <div class="col-md-4 col-lg-4 col-sm-12">
                        <div class="form-group">
                          <label for="phone">Phone</label><small class="text-danger">*</small>
                          <input type="text" maxlength="10" minlength="10" name="phone" class="form-control" id="phone" placeholder="XXXX-XXX-XXX" autocomplete="off" required>
                          <small class="text-danger err" id="phone-err"></small>
                        </div>
                      </div>
                     
                     <div class="col-md-4 col-lg-4 col-sm-12">
                        <div class="form-group">
                          <label for="birthdate">Birthdate</label><small class="text-danger">*</small>
                          <input type="text" class="form-control datetimepicker-input" name="birthdate" id="birthdate" data-toggle="datetimepicker" data-target="#birthdate" >
                          <small class="text-danger err" id="birthdate-err"></small>
                        </div>
                      </div>
                    </div>
                        
                      
                      
                      
                        
                                 
                  
   
                  
  
  
  <!--Next of Employees Next of Kin Starts Here-->      

<div class="row">
                      <div class="col-md-4 col-lg-4 col-sm-12">
                       <div class="form-group">
                        <label for="Next of Kin (NOK)">Next of Kin (NOK)</label><small class="text-danger">*</small>
                        <select class="form-control" name="nok" required>
                            <option selected value disabled>choose</option>
                            <option value="Spouse">Spouse</option>
                            <option value="Child">Child</option>
                            <option value="Parents">Parents</option>
                            <option value="Nephew">Nephew</option>
                            <option value="Cousing">Cousing</option>
                            <option value="Brother">Brother</option>
                            <option value="Sister">Sister</option>
                            <option value="Aunty">Aunty</option>
                            <option value="Uncle">Uncle</option>
                            <option value="Grand Mother">Grand Mother</option>
                            <option value="Grand Father">Grand Father</option>
                          </select>
                        
                      </div>
                      </div>
                      <div class="col-md-4 col-lg-4 col-sm-12">
                       <div class="form-group">
                        <label for="Name of NOK">Name of NOK</label><small class="text-danger">*</small>
                        <input type="text" name="name_of_nok" class="form-control" required>
                        </div>
                      </div>

                      <div class="col-md-4 col-lg-4 col-sm-12">
                       <div class="form-group">
                        <label for="Name of NOK">Phone of NOK</label><small class="text-danger">*</small>
                        <input type="number" name="phone_of_nok" class="form-control" required>
                        </div>
                      </div>
                    </div>








<!--Next of Kin Ends Here-->


  
  
  
  
  
                  
                    <div class="row">
                      <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="form-group">
                          <label for="address">Address</label>  <small class="text-danger">*</small>
                          <textarea class="form-control" id="address" name="address" rows="3" required></textarea>
                        </div>
                      </div>
                      <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="form-group">
                          <label for="remark">Work Description</label>  <small class="text-danger">*</small>
 <textarea class="form-control" id="remark" name="remark" rows="3" readonly>{{Auth::guard('Employees')->user()->remark}}</textarea>
                        </div>
                      </div>
                    </div>


                    <div class="row">
                      <div class="col-md-6 col-lg-6 col-sm-12">
                       <div class="form-group">
                        <label for="first_name">Employee TPIN</label><small class="text-danger">*</small>
                        <input type="text" maxlength="10" minlength="10" name="tpin" class="form-control" id="tpin" placeholder="Enter TPIN"  required>
                        
                      </div>
                      </div>
                      <div class="col-md-6 col-lg-6 col-sm-12">
                       <div class="form-group">
                        <label for="last_name">Company Identity Number</label><small class="text-secondary">(Company ID)</small>
                        <input type="number" name="security_number" class="form-control" value="{{Auth::guard('Employees')->user()->security_number}}" id="security_number" readonly>
                        
                      </div>
                      </div>
                    </div>



                    <div class="row">
                     
                            <button type="submit" onclick="return confirm('Are you sure?');" class="btn btn-primary">Proceed</button>
                            
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



 <script>  
 $('#birthdate').datetimepicker({
     format: 'LL',
  });
</script>



@include('employees/footer')