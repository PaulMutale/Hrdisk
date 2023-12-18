@include('employees/menu_header') 

<div class="main-panel shadow p-3 mb-5 bg-white rounded">
          <div class="content-wrapper">


<h4>Bank Details</h4>
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
<form method="post" action="{{route('employees.kyc_bank_details_submit')}}">
  @csrf
  
 <div class="form-group">
    <label for="Bank Branch">Bank Name</label>
    <input type="text" name="employee_bank_name" class="form-control" >
 </div> 
  
  
  
  <!--
  <div class="form-group">
    <label for="Bank Name">Bank Name</label>
    <select name="employee_bank_name" class="form-control selectpicker" data-live-search="true" >
      
      <option value="Absa Bank Zambia Plc">Absa Bank Zambia Plc</option>
        <option value="Access Bank Zambia Limited">Access Bank Zambia Limited</option>
        <option value="Atlas Mara Bank Zambia Limited">Atlas Mara Bank Zambia Limited</option>
        <option value="Bank of China Zambia Limited">Bank of China Zambia Limited</option>
        <option value="Citibank Zambia Limited">Citibank Zambia Limited</option>
        <option value="Ecobank Zambia Limited">Ecobank Zambia Limited</option>
        <option value="First Alliance Bank Zambia Limited">First Alliance Bank Zambia Limited</option>
        <option value="First Capital Bank Zambia Limited">First Capital Bank Zambia Limited</option>    
         <option value="First National Bank of Zambia Limited">First National Bank of Zambia Limited</option>
        <option value="Indo-Zambia Bank Limited">Indo-Zambia Bank Limited</option>
        <option value="Investrust Bank Zambia Limited">Investrust Bank Zambia Limited</option>
        <option value="Stanbic Bank Zambia Limited">Stanbic Bank Zambia Limited</option>    
        <option value="Standard Chartered Bank Zambia Plc">Standard Chartered Bank Zambia Plc</option>
        <option value="United Bank for Africa Zambia Limited">United Bank for Africa Zambia Limited</option>
        <option value="Zambia Industrial Commercial Bank Limited">Zambia Industrial Commercial Bank Limited</option>
        <option value="Zambia National Commercial Bank Plc">Zambia National Commercial Bank Plc</option>
      <option value="Zambia National Building Society">Zambia National Building Society</option>
      
    </select>      
    
  </div>
  -->

  <div class="form-group">
    <label for="Bank Branch">Bank Branch</label>
    <input type="text" name="employee_bank_branch" class="form-control" >
 </div>

 <div class="form-group">
    <label for="Bank Account Number">Bank Account Number</label>
    <input type="numeric" name="employee_bank_account_number" class="form-control" >
    
  </div>

  <div class="form-group required">
    <label for="Client Bank Account Type">Client Bank Account Type</label>
    <input type="text"  name="employee_bank_account_type" class="form-control" >
    
  </div>
  


  <div class="form-group required">
    <label for="Enter Mobile Money Number">Enter Mobile Money Number</label>
    <input type="numeric" maxlength="10" name="employee_mobile_money_number" class="form-control form-control-sm" >
    
    
  </div>
  
  <div class="form-group required">
    <label for="Enter Mobile Money Name">Enter Mobile Money Name</label>
    <input type="text" name="employee_mobile_money_name" class="form-control form-control-sm" >
   
  </div>
  
  <button type="submit" class="btn btn-primary">Next</button>
</form>
</div>







@include('employees/footer')