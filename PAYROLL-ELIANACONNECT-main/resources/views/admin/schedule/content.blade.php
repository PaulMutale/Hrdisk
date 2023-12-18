<!--Live Schedule Data-->

<div class="card-header">
  <div class="col-md-6 d-block">
    <a href="{{ $add_new }}" class="btn btn-sm btn-dark float-left"><i class="ik plus-square ik-plus-square"></i> Create Schedule</a>
  </div>
 
</div>
<script> 

$(document).ready(function() {
    $('#state_data_table').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'pdf', 'csv', 'excel', 'copy', 'print'
        ]
    });
});



</script>

<div class="shadow p-3 mb-5 bg-white rounded">
  <table id="state_data_table" class="table mb-0 table-hover">
    <thead>
      <tr>
       
        <th >No.</th>
        <th >Time In</th>
        <th >Time Out</th>
        <th >Actions</th>
      </tr>
    </thead>
    <tbody>
      @foreach($schedules as $schedule)
      <tr>
       
        <td >
          {{ ($loop->index + 1) }}
        </td>
        <td>
          <div >
            <span><b>{{ $schedule->time_in }}</b></span>
          </div>
        </td>
        <td >
          <span><b>{{ $schedule->time_out }}</b></span>
        </td>
        <td >
            <div class="btn-group btn-sm" role="group" aria-label="Basic example">
              <a href="{{ route('admin.schedule.edit',['schedule'=>$schedule]) }}" type="button" class="btn btn-sm btn-outline-primary">
                <i class="ik edit-2 ik-edit-2"></i>
              </a>
              <a data-href="{{ route('admin.schedule.destroy',['schedule'=>$schedule]) }}" type="button" class="btn btn-sm btn-outline-danger delete">
                <i class="ik trash-2 ik-trash-2"></i>
              </a>
            </div>
        </td>
      </tr>
      @endforeach
    </tbody>
   
  </table>
</div>

<!--EndLive Schedule Data-->
