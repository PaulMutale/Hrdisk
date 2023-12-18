<!--data here-->
<div class="tab-content" id="pills-tabContent">
  <div class="tab-pane fade active show" id="live" role="tabpanel" aria-labelledby="pills-timeline-tab">

   
    </div>

    

<div class="card-body table-responsive">
        <table id="employee_data_table" class="table table-striped">
          <thead>
            <tr>
              <th>Avatar</th>
              <th>First Name</th>
              <th>Last Name</th>
              <th>Phone</th>
              <th>Email</th>
              <th>Position</th>
              <th>Details</th>
              <th>Payroll</th>
              <th>Restore</th>
             
            </tr>
          </thead>
          <tbody>
            @foreach($employees as $k => $employee)
            <tr>
             <td>
               <img src="{{$employee->mediaUrl['thumb']}}" class='table-user-thumb'>
             </td>
             <td>{{ $employee->first_name }}</td>
             <td>{{ $employee->last_name }}</td>
             <td>{{ $employee->phone }}</td>
             <td>{{ $employee->email }}</td>
             <td>{{ $employee->position->title }}</td>
             <td>
               <div class=''>
                <b>Gender :</b> <span>{{$employee->gender}}</span></br>
                <b>Employee Id :</b> <span>{{$employee->employee_id}}</span></br>
                <b>Schedule :</b> <span>{{$employee->schedule->time_in.'-'.$employee->schedule->time_out}}</span></br>
                <b>Address :</b> <span>{{$employee->address}}</span></br>
              </div>
             </td>
             <td>
             
                <i class='ik ik-alert-circle text-danger alert-status' title='In-Active Employee'></i>
              
             </td>
             






             <td>
               <div class='table-actions'>
              
                <a href="{{route('admin.employee.restore',encrypt($employee->id))}}">
                <i class="fa fa-undo" aria-hidden="true"></i>
                </a>
               
              </div>
             </td>
            
            </tr>
            @endforeach
          </tbody>
        </table>
    </div>
    <!--End Live Banner Data-->

  </div>
</div>
<!--End data here-->

<script type="text/javascript">
  $(document).ready(function(){
    $("#employee_data_table").DataTable({
     'dom': 'Bfrtip',
      buttons: [
                   {
                       extend: 'pdf',
                       exportOptions: {
                           columns: [1,2,3,4,5] // Column index which needs to export
                       }
                   },
                   {
                       extend: 'csv',
                       exportOptions: {
                           columns: [1,2,3,4,5] // Column index which needs to export
                       }
                   },
                   {
                       extend: 'excel',
                       exportOptions: {
                           columns: [1,2,3,4,5] // Column index which needs to export
                       }
                   },
                   {
                       extend: 'print',
                       exportOptions: {
                           columns: [1,2,3,4,5] // Column index which needs to export
                       }
                   },
              ],
    })   
});
</script>