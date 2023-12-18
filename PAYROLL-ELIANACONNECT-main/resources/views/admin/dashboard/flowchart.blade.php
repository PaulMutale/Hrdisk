

<h4>Organisation setup Summary Progress</h4>
<br><br>
<div class="stepper-wrapper">
@if(\App\Position::where('security_number',"=",Auth::user()->security_number)->exists())
<div class="stepper-item completed">
  <div class="step-counter"><span style="color:white">1</span></div>
    <div class="step-name">Upload Structure</div>
  </div> 
  
  @else

  <div class="stepper-item ">
    <div class="step-counter"><span style="color:white">1</span></div>
    <div class="step-name"><a href="{{route('admin.import_position_file')}}">Click Me For - Step 1 </a></div>
  </div> 
 @endif
  




 @if(\App\Tax::where('security_number',"=",Auth::user()->security_number)->exists()
  && \App\Insurance::where('security_number',"=",Auth::user()->security_number)->exists() 
  && \App\pension::where('security_number',"=",Auth::user()->security_number)->exists())
  <div class="stepper-item completed">
    <div class="step-counter color:white"><span style="color:white">2</span></div>
    <div class="step-name">Statutories </div>
  </div>
@else
<div class="stepper-item">
    <div class="step-counter"><span style="color:white">2</span></div>
    
    @php 
    $country = \App\Admin::where('company_country',"=",Auth::user()->company_country)->where('tax_done',"=",1)->where('pension_done',"=",1)->where('insurance_done',"=",1)->first(); 
    @endphp

    @if($country)
   <p>Please confirm your country's statutories <a style="color: royalblue" href="{{route('admin.collected_statutories')}}">here</a></p>
  @else
    <div class="step-name"><a href="{{route('admin.tax_view')}}">Click Me For - Step 2</a></div>
    @endif
  </div>
  @endif


 @if(\App\Deduction::where('security_number',"=",Auth::user()->security_number)->exists())
  <div class="stepper-item completed">
    <div class="step-counter color:white"><span style="color:white">3</span></div>
    <div class="step-name">Define Third Party Service Providers</div>
  </div>
@else
<div class="stepper-item">
    <div class="step-counter"><span style="color:white">3</span></div>
    <div class="step-name"><a href="{{route('admin.import_deduction_file')}}">Click Me For - Step 3</a></div>
  </div>
  @endif
  

  @if(\App\Schedule::where('security_number',"=",Auth::user()->security_number)->exists())
  <div class="stepper-item completed">
    <div class="step-counter color:white"><span style="color:white">4</span></div>
    <div class="step-name">Set Employee Shifts</div>
  </div>
@else
<div class="stepper-item">
    <div class="step-counter"><span style="color:white">4</span></div>
    <div class="step-name"><a href="{{ route('admin.schedule.create') }}">Click Me For - Step 4</a></div>
  </div>
  @endif



  @if(\App\Employee::where('security_number',"=",Auth::user()->security_number)->exists())
  <div class="stepper-item completed">
    <div class="step-counter color:white"><span style="color:white">5</span></div>
    <div class="step-name">Invite Employees</div>
  </div>
</div>
@else  
<div class="stepper-item">
    <div class="step-counter"><span style="color:white">5</span></div>
    <div class="step-name"><a href="{{ route('admin.employee.create') }}">Click Me For - Step 5</a></div>
  </div>
</div>
@endif




<style>
  .stepper-wrapper {
  margin-top: auto;
  display: flex;
  justify-content: space-between;
  margin-bottom: 20px;
}
.stepper-item {
  position: relative;
  display: flex;
  flex-direction: column;
  align-items: center;
  flex: 1;

  @media (max-width: 768px) {
    font-size: 12px;
  }
}

.stepper-item::before {
  position: absolute;
  content: "";
  border-bottom: 2px solid #ccc;
  width: 100%;
  top: 20px;
  left: -50%;
  z-index: 2;
}

.stepper-item::after {
  position: absolute;
  content: "";
  border-bottom: 2px solid #ccc;
  width: 100%;
  top: 20px;
  left: 50%;
  z-index: 2;
}

.stepper-item .step-counter {
  position: relative;
  z-index: 5;
  display: flex;
  justify-content: center;
  align-items: center;
  width: 40px;
  height: 40px;
  border-radius: 50%;
  background: #ccc;
  margin-bottom: 6px;
}

.stepper-item.active {
  font-weight: bold;
}

.stepper-item.completed .step-counter {
  background-color: #4bb543;
}

.stepper-item.completed::after {
  position: absolute;
  content: "";
  border-bottom: 2px solid #4bb543;
  width: 100%;
  top: 20px;
  left: 50%;
  z-index: 3;
}

.stepper-item:first-child::before {
  content: none;
}
.stepper-item:last-child::after {
  content: none;
}
</style>
























