@include('employees/menu_header') 

<div class="main-panel shadow p-3 mb-5 bg-white rounded">
          <div class="content-wrapper">


<h4>Files Uploads</h4>
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
<form method="post" action="{{route('employees.kyc_files_details_submit')}}" enctype="multipart/form-data">
  @csrf
  <div class="form-group required">
    <label for="Medical Forms">Medical Forms</label>
    <input type="file" name="employee_medicals" class="form-control" >
    <small>upload in PDF Format</small>
  </div>
  
  <div class="form-group required">
    <label for="Passport Photo">Passport Photo</label><small class="text-danger">*</small>
    <input type="file" name="employee_passport_photo" class="form-control" required>
    <small>upload your clear passport photo</small>
  </div>

  
  <button type="submit" class="btn btn-primary">Next</button>
</form>
</div>







@include('employees/footer')