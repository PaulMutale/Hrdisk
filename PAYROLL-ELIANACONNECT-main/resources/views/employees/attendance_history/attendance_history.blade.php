@include('employees/menu_header') 

<div class="main-panel shadow p-3 mb-5 bg-white rounded">
          <div class="content-wrapper">


<h4>Attendance History</h4>
<hr>


<table class="table table-striped" id="attendance_table">
  <thead>
    <tr>
    
      <th>Date</th>
      <th>Loggen In</th>
      <th>Logged Out</th>
      <th>Hours Worked</th>
    </tr>
  </thead>
  <tbody>
  @foreach ($attendances as $attendance)  
    <tr>
       
        
      <td>{{ \Carbon\Carbon::parse($attendance->date)->format('d,M Y') }}</td>
      <td>{{$attendance->time_in}}</td>
      <td>{{$attendance->time_out}}</td>
      <td>{{$attendance->hours_worked}}</td>
      
    </tr>
    @endforeach
  </tbody>
</table>


<script>  
    $(document).ready( function () {
    $('#attendance_table').DataTable();
} );
</script>

@include('employees/footer')