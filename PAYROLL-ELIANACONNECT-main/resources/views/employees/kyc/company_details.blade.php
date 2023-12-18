@include('employees/menu_header') 

<div class="main-panel shadow p-3 mb-5 bg-white rounded">
          <div class="content-wrapper">


<h4>{{$company_name}}</h4>
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
<form method="post" action="{{route('employees.kyc_company_details_submit')}}">
  @csrf
  <div class="form-group">
    <label for="Positions">Positions - Vacancies (Assigned by HR: {{\App\Position::find(Auth::guard('Employees')->user()->position_id)->title}})</label><small class="text-danger">*</small>
    <select name="position_id" class="form-control selectpicker" data-live-search="true" >
      @foreach ($profile_vacancies as $position)
      <option value="{{$position->id}},{{$position->vacancies}}">{{$position->title}} - {{$position->vacancies}}</option>
@endforeach
      
    </select>      
    
  </div>
  

  <div class="form-group">
    <label for="Time In">Time In - Time Out (Assigned by HR: {{\App\Schedule::find(Auth::guard('Employees')->user()->schedule_id)->time_in}} : {{\App\Schedule::find(Auth::guard('Employees')->user()->schedule_id)->time_out}})</label><small class="text-danger">*</small>
    <select name="schedule_id" class="form-control selectpicker" data-live-search="true" >
      @foreach ($profile_schedule as $schedule)
      <option value="{{$schedule->id}}">{{$schedule->time_in}} - {{$schedule->time_out}}</option>
@endforeach
      
    </select>
    <br>
    <button type="submit" class="btn btn-primary">Next</button>  
  </div>   
</div>

</form>






@include('employees/footer')