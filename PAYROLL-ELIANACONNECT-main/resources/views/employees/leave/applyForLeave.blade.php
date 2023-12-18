@include('employees/menu_header') 

<div class="main-panel shadow p-3 mb-5 bg-white rounded">
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
<form method="post" action="{{route('employees.leave_details_submit')}}" onsubmit="return check()">
  @csrf
  <div class="form-group">
    <label for="Bank Name">Select Leave</label>
    @if($months < 6 )
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong><i class="fa fa-bell" aria-hidden="true"></i> Whoooops!</strong> You are not qualified for a local leave. To qualify for a local leave you need to be in employment for atleast 6 Months
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>

@elseif($months >= 6 && $months < 12)
<select name="leave_name" class="form-control selectpicker" data-live-search="true" id="leaves">
      
      
      <option value="Local Leave">Local Leave - 10 days</option>
      <option id="Leave Commutation" value="Leave Commutation">Leave Commutation</option>
      <!--
      <option value="Partenal Leave">Partenal Leave</option>
-->
    
  </select> 
  <br>
  
  <div class="form-group" id="cld" style="display:none ;">
    <label for="Commutation leave days">Commutation leave days (Maximum is: {{$remaining_leaves}} days)</label>
    <input max="{{$remaining_leaves}}" id="commutable_leave_days" type="number" name="commuted_days" class="form-control" >
 </div>



  @elseif($months >= 12 && $months < 24 )
<select name="leave_name" class="form-control selectpicker" data-live-search="true" id="leaves">
      
     <option value="Annual Leave">Annual Leave - 24 days</option>
      <option value="Local Leave">Local Leave - 10 days</option>
      <option value="Partenal Leave">Partenal Leave - 5 days</option>  
      <option id="Leave Commutation" value="Leave Commutation">Leave Commutation</option>                                          

    
  </select>  

  <br>
  
  <div class="form-group" id="cld"  style="display: none;">
    <label for="Commutation leave days">Commutation leave days (Maximum is: {{$remaining_leaves}} days)</label>
    <input max="{{$remaining_leaves}}" id="commutable_leave_days" type="number" name="commuted_days" class="form-control" >
 </div>



  @else($months >= 24)
<select name="leave_name" class="form-control selectpicker" data-live-search="true" id="leaves">
      
     <option value="Annual Leave">Annual Leave - 24 days</option>
      <option value="Local Leave">Local Leave - 10 days</option>
      <option value="Martenal Leave">Martenal Leave - 14 days</option>
      <option value="Partenal Leave">Partenal Leave - 5 days</option>    
      <option id="Leave Commutation" value="Leave Commutation">Leave Commutation</option>                                        

    
  </select>  
   
    <br>
  
  <div class="form-group" id="cld" style="display: none ;">
    <label for="Commutation leave days">Commutation leave days (Maximum is: {{$remaining_leaves}} days) </label>
    <input max="{{$remaining_leaves}}" id="commutable_leave_days" type="number" name="commuted_days" class="form-control" >
 </div>


  
    @endif
   
    
  </div>

  <div class="form-group" id="startDate">
    <label for="Bank Branch">Leave start date</label>
    <input id="date1" type="date" name="leave_start_date" class="form-control">
 </div>

 <div class="form-group" id="endDate">
    <label for="Bank Branch">Leave end date</label>
    <input id="date2" type="date" name="leave_end_date" class="form-control">
 </div>


 <div class="form-group">
    <label for="Accrued Leave Days">Accrued Leave Days</label>
    <input type="number" name="accrued_leaves" value="{{$accrued_leaves}}" class="form-control" readonly>
 </div>


  <div class="form-group">
    <label for="Bank Branch">Leaves taken</label>
    <input type="number" name="exhausted_leaves" value="{{$exhausted_leaves}}" class="form-control" readonly>
 </div>

 <div class="form-group">
    <label for="Bank Account Number">Remaining Leave(s)</label>
    <input type="numeric" name="remaining_leaves" value="{{$remaining_leaves}}" class="form-control" readonly>
    
  </div>

  
  @if($months > 6 )
  <button type="submit" class="btn btn-primary">Submit for review</button>
  @endif
</form>
</div>



  <script type="text/javascript">
  $(document).ready(function () {

$("#leaves").change(function (event) {
    if ($(this).val() === 'Leave Commutation') { 
        
        
            document.getElementById("cld").style.display = "block";
            document.getElementById("startDate").style.display = "none";
            document.getElementById("endDate").style.display = "none";
            
        } 
        else{
            
            document.getElementById("cld").style.display = "none";
            document.getElementById("startDate").style.display = "block";
            document.getElementById("endDate").style.display = "block";
        }  
    
});
});



function check(){
      if(document.getElementById("Leave Commutation").selected && (!document.getElementById("commutable_leave_days").value)){
        alert("Enter the number of days you are commuting to the company");
        return false;
      }

      if(!document.getElementById("Leave Commutation").selected && (!document.getElementById("date1").value)){
        alert("Please Enter the leave start Date");
        return false;
      }

      if(!document.getElementById("Leave Commutation").selected && (!document.getElementById("date2").value)){
        alert("Please Enter the leave end Date");
        return false;
      }



    }
  
</script>




@include('employees/footer')