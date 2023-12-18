@include('employees/menu_header') 

<div class="main-panel shadow p-3 mb-5 bg-white rounded">
          <div class="content-wrapper">


<h4>Leave History</h4>
<hr>


<table class="table table-striped" id="leave_table">
  <thead>
    <tr>
       
      <th scope="col">Leave Name</th>
      <th scope="col">Accrued Leaves</th>
      <th scope="col">Exhausted Leaves</th>
      <th scope="col">Remaining Leaves</th>
      <th scope="col">Leave Start Date</th>
      <th scope="col">Leave End Date</th>
      <th scope="col">Commutation</th>
    </tr>
  </thead>
  <tbody>
  @foreach ($leaves as $leave) 
    <tr>
        
      <th scope="row">{{ $leave->leave_name }}</th>
      <th scope="row">{{ $leave->accrued_leaves }}</th>
      <th scope="row">{{ $leave->exhausted_leaves }}</th>
      <th scope="row">{{ $leave->remaining_leaves }}</th>
      <th scope="row">{{ $leave->leave_start_date }}</th>
      <th scope="row">{{ $leave->leave_end_date }}</th>
      <th scope="row">{{ $leave->commutation_balance }}</th>
     
      
    </tr>
    @endforeach
  </tbody>
</table>



<script>  
    $(document).ready( function () {
    $('#leave_table').DataTable();
} );


</script>
@include('employees/footer')