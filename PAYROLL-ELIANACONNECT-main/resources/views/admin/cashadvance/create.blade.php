@extends('admin.layout.app')

@section('title') Create Cash Advance @endsection

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
           <i class="ik ik-at-sign bg-blue"></i>
           <div class="d-inline">
              <h5>Salary Advance</h5>
              <span>Create Salary Advance, Please fill all field correctly.</span>
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
             <a href="{{ route('admin.cashadvance.index') }}">Salary Advance</a>
         </li>
         <li class="breadcrumb-item active" aria-current="page">Create</li>
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
                    <span class="overlay-text">New Salary Advance Creating...</span>
                </div>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="state">
                        <h5 class="text-secondary">Create Salary Advance</h5>
                    </div>
                </div>

                <form action="{{ $form_store }}" method="POST" enctype="multipart/form-data" id="createCashadvance">
                    @csrf
                    <div class="row">
                      <div class="col-md-8 col-lg-8 col-sm-12">
                       <div class="form-group">
                        <label for="title">Title</label><small class="text-danger">*</small>
                        <input type="text" name="title" placeholder="Some reason for a loan" class="form-control" id="title" autocomplete="off">
                        <small class="text-danger err" id="title-err"></small>
                      </div>
                      </div>
                      <div class="col-md-4 col-lg-4 col-sm-12">
                        <div class="form-group">
                          <label for="date">Loan Amount</label><small class="text-danger">*</small>
                          <input type="number" name="employee_loan_amount" onkeyup="calculateEMI()" value="{{ old('employee_loan_amount') }}"  class="form-control"  id="amount" required>
                          <small class="text-danger err" id="date-err">This is the employee requested loan amount</small>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12 col-lg-12 col-sm-12">
                       <div class="form-group">
                        <label for="employee_id">Employee</label><small class="text-danger">*</small>
                        <select class="form-control" name="employee_id" id="employee_id">
                          @foreach($employees as $employee)
                            <option value="{{ $employee->id }}">{{ $employee->first_name." ".$employee->last_name." (#".$employee->employee_id.")" }}</option>
                          @endforeach
                        </select>
                        <small class="text-danger err" id="employee_id-err"></small>
                      </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12 col-lg-12 col-sm-12">
                       <div class="form-group">
                        <label for="rate_amount">Duration</label><small class="text-danger">*</small>
                        <input type="number"  onkeyup="calculateEMI()" name="employee_duration" value="{{ old('employee_duration') }}" class="form-control"  id="installments" required>
                        <small class="text-danger err" id="rate_amount-err">This is the loan duration.</small>
                      </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-12 col-lg-12 col-sm-12">
                       <div class="form-group">
                        <label for="rate_amount">Total Repayments</label><small class="text-danger">*</small>
                        <input type="text" class="form-control" name="employee_total_repayment" value="{{ old('employee_total_repayment') }}"  id="total" readonly>
                        <small class="text-danger err" id="rate_amount-err">This is the total repayment amount.</small>
                      </div>
                      </div>
                    </div>


                    <div class="row">
                      <div class="col-md-12 col-lg-12 col-sm-12">
                       <div class="form-group">
                        <label for="rate_amount">EMI</label><small class="text-danger">*</small>
                        <input type="text" name="employee_monthly" class="form-control" value="{{ old('employee_monthly') }}" name id="monthly" readonly>
                        <small class="text-danger err" id="rate_amount-err">Equated Monthly Installment</small>
                      </div>
                      </div>
                    </div>


                    <div class="row">
                      <div class="col-md-12 col-lg-12 col-sm-12">
                       <div class="form-group">
                        <label for="rate_amount">Date</label><small class="text-danger">*</small>
                        <input type="date" name="date" class="form-control" >
                      </div>
                      </div>
                    </div>


                    <div class="row">
                      <div class="col-md-12 col-lg-12 col-sm-12">
                        <button type="submit" class="btn btn-primary"><i class="ik save ik-save"></i>Submit</button>
                        <a href="{{ route('admin.cashadvance.index') }}" class="btn btn-light"><i class="ik arrow-left ik-arrow-left"></i> Go Back</a>
                      </div>
                    </div>


<!--Company security Number-->
<input type="hidden" name="security_number" value="{{Auth::user()->security_number}}"/>





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
  $('#date').datetimepicker({
    format: 'LL'
  });
  $("#createCashadvance").submit(function(event){
    event.preventDefault();
    createForm("#createCashadvance");
  }); 
});








function calculateEMI() {


   

             var installments = document.getElementById('installments').value;
            if (!installments)
                installments = '0';


                var loan_amount =document.getElementById('amount').value;
            if (!loan_amount)
                loan_amount = '0';
                
                
                             


            var loan_amount = parseFloat(loan_amount);
            var loan_percent = 0;
            var installments = parseFloat(installments);
           
            

            
            



var total = (loan_amount)+((loan_amount)*(loan_percent/100)*installments);
 document.getElementById('total').value = parseFloat(total).toFixed(2);
 document.getElementById('monthly').value = parseFloat((total/installments)).toFixed(2);
 
           
        }
      
</script>
@endsection