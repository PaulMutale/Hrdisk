<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Payslips | E-System - A System for HR Payment Generator. </title>




  
  <style type="text/css">
    .page-break {
      page-break-after: always;
    }

    body {
      position: relative;
      width: auto;
      height: 29.7cm;
      color: #001028;
      background: #FFFFFF;
      font-size: 14px;
      font-family: 'helvetica';
    }

    table {
      width: 100%;
      border-collapse: collapse;
      border-spacing: 0;
      margin-bottom: 20px;
    }

    table tr:nth-child(2n-1) td {
      background: #F5F5F5;
    }

    table th,
    table td {
      text-align: center;
    }

    table th {
      padding: 5px 20px;
      color: #5D6975;
      border-bottom: 1px solid #C1CED9;
      white-space: nowrap;
      font-weight: normal;
    }

    table td {
      padding: 10px;
      text-align: left;
    }

    .text-center {
      text-align: center;
    }

    .border-top-bootom-1 {
      border-top: 1px solid #C1CED9;
      border-bottom: 1px solid #C1CED9;
    }

    .py-4 {
      padding-top: 16px;
      padding-bottom: 16px;
    }

    .my-4 {
      margin-top: 16px;
      margin-bottom: 16px;
    }

    .px-4 {
      padding-left: 16px;
      padding-right: 16px;
    }

    .mx-4 {
      margin-left: 16px;
      margin-right: 16px;
    }

    .row-inline-block {
      display: inline-block;
    }

    .row>.col-4 {
      width: 33%;
      display: inline-block;
    }

    .row>.col-6 {
      width: 49%;
      display: inline-block;
    }

    .border-1 {
      border: 1px solid #C1CED9;
    }

    .text-right {
      text-align: right;
    }

    .block {
      text-align: right;
    }

    .block p {
      width: 50%;
    }

    .column {
      float: left;
      width: 50%;
    }

    /* Clear floats after the columns */
    .row-css:after {
      content: "";
      display: table;
      clear: both;
    }
  </style>
</head>

<body>

    
      <br>
    
  <div class="card border-1">
    <div class="card-header">
    <h2 class="text-center border-top-bootom-1 py-4">{{Auth::user()->username}} - EMPLOYEE PAYMENT SLIPS</h2>
    <h3 class="text-center border-top-bootom-1 py-4">{{Auth::user()->company_address}}</h3>
    <center>
    
  @if(Auth::user()->company_logo == "NULL" || Auth::user()->company_logo == "Null")
   <img src="https://eu.ui-avatars.com/api/?name={{Auth::user()->username}}" class="img-fluid my-5" width="100" height="100" alt="Company Logo"/> 
  @else
 <img src="{{asset('LOGOS_UPLOADS/'.Auth::user()->company_logo)}}" class="img-fluid my-5" width="100" height="100" alt="Company Logo"/> 
  @endif
  
  </center>
    <h2 class="text-center border-top-bootom-1 py-4">{{ $payDay }}</h2>
    </div>
    <div class="card-body border">

@php


 $total_hours_worked = 0;
            foreach($payslip->attendances as $hours){
            $total_hours_worked += (empty($hours->hours_worked) ? 0 : $hours->hours_worked);
            }




if($total_hours_worked < 0) {
  $basic_pay = ($total_hours_worked * $payslip->rate_per_hour);
}

else{
  $basic_pay = ($payslip->salary);

}

@endphp


      <div class="row">
        <div class="col-12 table-responsive">
          <table cellspacing="0" cellpadding="3" class="table">
            <tr>
              <td width="25%" align="right">Employee Name: </td>
              <td width="25%"><b>{{ $payslip->first_name." ".$payslip->last_name }}</b></td>
              <td width="25%" align="right">Rate per Hour: </td>
              <td width="25%" align="right">K{{ $payslip->rate_per_hour }}</td>
            </tr>
            <tr>
              <td width="25%" align="right">Employee ID: </td>
              <td width="25%">{{ $payslip->employee_id }}</td>
              <td width="25%" align="right">Hours Worked: </td>
              <td width="25%" align="right">{{ $total_hours_worked }}</td>
            </tr>
            <tr>

              <td width="25%" align="right"><b>Basic Pay: </b></td>
              <td width="25%" align="right"><b>K{{ number_format($basic_pay,2) }}</b></td>
              <td><b>Deductions</b></td>
              <td><b>Allowances</b></td>
            </tr>
            <tr>


              <td></td>
              <td></td>
              <td width="25%" align="right">
                <p style="font-weight:bold">
                <p>
                  
                Tax: {{number_format($payee,2)}}
                  </p>
                       
                  @if($pension->applied_on === 'GROSS PAY')
                  <p>{{$pension->pension_name}}: K{{ number_format($gross_earnings*($pension->pension/100),2) }}</p>
                    @php 
                    $pension_value =  number_format($gross_earnings*($pension->pension/100),2);
                    @endphp
                 
                  @endif  
                  @if($pension->applied_on === 'BASIC PAY')
                  <p>{{$pension->pension_name}}: K{{ number_format($basic_pay*($pension->pension/100),2) }}</p>
                  @php 
                    $pension_value =  number_format($basic_pay*($pension->pension/100),2);
                    @endphp
                  @endif  

                 @if($insurance->applied_on === 'GROSS PAY') 
                  <p>{{$insurance->insurance_name}}: K{{ number_format($gross_earnings*($insurance->insurance/100),2) }}</p>
                 
                  @php
                 $insurance_value = number_format($gross_earnings*($insurance->insurance/100),2);
                 @endphp
                  @endif  
                  
                  @if($insurance->applied_on === 'BASIC PAY') 
                  <p>{{$insurance->insurance_name}}: K{{ number_format($basic_pay*($insurance->insurance/100),2) }}</p>
                  @php
                 $insurance_value = number_format($basic_pay*($insurance->insurance/100),2);
                 @endphp
                 
                  @endif  
        
                  
<!--Standard Deductions--> 
@foreach($standard_deductions as $normal_deductions)
@if($normal_deductions->amount != 0)
                        <p>{{$normal_deductions->name}}: K{{$normal_deductions->amount}}</p>
@endif
@endforeach
<!--End standard Deductions-->


  <!--Third Party Deductions-->                
                  
                  @foreach($deductions as $deduction)
@if($deduction->amount != 0)
                        <p>{{$deduction->deduction_name}}: K{{$deduction->amount}}</p>
@endif
                        @endforeach
                        <!--End Third Party Deductions-->

                        <!--Salary Advance Deductions-->
                        @if($salary_advance)
                        <p>Salary Advance: K{{number_format($salary_advance->emi,2)}}</p>    
                        <!--End Salary Advace Deductions-->                      
                        <div style="display: none;">


@if($salary_advance->runMonth != date('F-Y',strtotime($payDay)))                        
{{$salary_advance->update([
  'duration' => ($salary_advance->duration - 1),
  'total_repayments' => ($salary_advance->emi +  $salary_advance->total_repayments),
  'runMonth' => date('F-Y',strtotime($payDay)) 
  ])  
}}
@endif

@if($salary_advance->duration == 0)
{{$salary_advance->update([
  'loan_status' => 4,
  ])  
}}

@endif
</div> 
@endif
              </td>
              <td width="25%" align="right">
              @if($housing_allowance != 0)
                <p>Housing: K{{$housing_allowance}}</p>
                
                @endif
                @if($transport_allowance != 0)
                <p>Transport: K{{$transport_allowance}}</p>
                
                @endif

                @if($total_overtime_amount != 0)
                <p>Overtime:K{{ number_format($total_overtime_amount,2) }}</p>
                @endif


               @if($bonus_amount != 0)
                <p>{{$bonus_name}}:K{{ number_format($bonus_amount,2) }}</p>
                @endif

                @if($achievements_amount != 0)
                <p>{{$achievements_name}}:K{{ number_format($achievements_amount,2) }}</p>
                @endif



              </td>
            </tr>
           
            <tr>
              <td></td>
              <td></td>
              @if($salary_advance)
              <td width="25%" align="right"><b>Total:</b> {{ number_format($deduction_amount + $total_standard_deductions + $pension_value + $insurance_value  + ($payee) + $salary_advance->emi,2) }} </td>
              <td width="25%" align="right"><b>Gross Pay:</b> K{{ number_format(($basic_pay)+$housing_allowance + $transport_allowance+$total_overtime_amount + $bonus_amount + $achievements_amount,2) }}</td>
           @else
           <td width="25%" align="right"><b>Total:</b> {{ number_format($deduction_amount + $total_standard_deductions + $pension_value + $insurance_value + ($payee),2) }} </td>
           <td width="25%" align="right"><b>Gross Pay:</b> K{{ number_format(($basic_pay)+$housing_allowance + $transport_allowance+$total_overtime_amount + $bonus_amount + $achievements_amount,2) }}</td>
           @endif

            </tr>

            <tr>
              <td></td>
              <td></td>
              <td width="25%" align="right"><b>Net Pay:</b></td>
              <td width="25%" align="right"><b>
              @if($salary_advance)
                  K{{ number_format((($basic_pay)+$housing_allowance + $transport_allowance +$total_overtime_amount + $bonus_amount + $achievements_amount) - ($deduction_amount + $total_standard_deductions +($pension_value) + ($insurance_value) + ($payee) + $salary_advance->emi),2)}}
               
              @else   
              K{{ number_format((($basic_pay) + $housing_allowance + $transport_allowance +$total_overtime_amount + $bonus_amount + $achievements_amount) - ($deduction_amount + $total_standard_deductions + ($pension_value) + ($insurance_value) + ($payee)),2)}} 
              @endif
                </b></td>
            </tr>
          </table>
          @if($salary_advance)
<!-- Insert Data in the Database--> 
<div style="display: none;">
{{\App\PayrollRecords::updateOrCreate([
    
    'security_number'   => Auth::user()->security_number,
    'monthYear'   => $monthYear,
    'employee_id' => $payslip->employee_id     
], [
  'employee_name' => $payslip->first_name." ".$payslip->last_name,
  'employee_id' => $payslip->employee_id, 
  'monthYear' => $monthYear, 
  'tpin'=>$payslip->tpin,
  'phone'=>$payslip->phone,
  'napsa' =>  round($pension_value),
  'nhima' =>  round($insurance_value),
  'payee' =>  round($payee),
  'security_number' =>  Auth::user()->security_number,
  'net'=>((($basic_pay)+$housing_allowance + $transport_allowance +$total_overtime_amount + $bonus_amount + $achievements_amount) - ($deduction_amount +($pension_value) + ($insurance_value) + ($payee) + $salary_advance->emi)),  
  ])
}}
</div> 
@else    


<div style="display: none;">
{{\App\PayrollRecords::updateOrCreate([
    
    'security_number'   => Auth::user()->security_number,
    'monthYear'   => $monthYear,
    'employee_id' => $payslip->employee_id 
],  
  [
  'employee_name' => $payslip->first_name." ".$payslip->last_name,
  'employee_id' => $payslip->employee_id, 
  'monthYear' => $monthYear, 
  'tpin'=>$payslip->tpin,
  'phone'=>$payslip->phone,
  'napsa' =>  round($pension_value),
  'nhima' =>  round($insurance_value),
  'payee' =>  round($payee),
  'security_number' =>  Auth::user()->security_number,
  'net'=>((($basic_pay)+$housing_allowance + $transport_allowance +$total_overtime_amount + $bonus_amount + $achievements_amount) - ($deduction_amount +($pension_value) + ($insurance_value) + ($payee))),  
  ])
}}
</div>





@endif
<!--End Insert Data--> 

          <hr>
        </div>
      </div>
            
    </div>
  </div>
</body>

</html>