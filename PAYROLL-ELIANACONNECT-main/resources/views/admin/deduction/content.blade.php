<!--Live Deduction Data-->
<div class="card-header">
  <div class="col-md-6 d-block">
    <a href="{{ $add_new }}" class="btn btn-sm btn-dark float-left"><i class="ik plus-square ik-plus-square"></i> Add Third Party Service Provider </a>
  </div>
 
</div>
<script type="text/javascript">
  $(document).ready(function() {
    $('#state_data_table').DataTable({
        dom: 'Bfrtip',
        buttons: [
             'pdf','csv', 'excel', 'copy','print'
        ]
    });
});
</script>
<div class="card-body table-responsive p-0">
  <table id="state_data_table" class="table mb-0 table-hover">
    <thead>
      <tr>
        <th width="2" class="text-center">No.</th>
        <th width="35" class="text-center">Name</th>
        <th width="10" class="text-center">Code</th>
        <th width="45">Description</th>
        <th width="5">Actions</th>
        
      </tr>
    </thead>
    <tbody>
      @foreach($deductions as $deduction)
      <tr>
        <td class="text-center">
          {{ ($loop->index + 1) }}
        </td>
        <td>
          <div class="text-center">
            <span><b>{{ $deduction->name }}</b></span>
            <code class="pc">{{ $deduction->employee_id }}</code>
          </div>
        </td>
        <td class="text-center">
          <span><b>{{ $deduction->deduction_code }}</b></span>
        </td>
        <td>
          <p>{{ $deduction->description }}</p>
        </td>
        <td>
            <div class="btn-group btn-sm" role="group" aria-label="Basic example">
              <a href="{{ route('admin.deduction.edit',['deduction'=>$deduction]) }}" type="button" class="btn btn-sm btn-outline-primary">
                <i class="ik edit-2 ik-edit-2"></i>
              </a>
              <a data-href="{{ route('admin.deduction.destroy',['deduction'=>$deduction]) }}" type="button" class="btn btn-sm btn-outline-danger delete">
                <i class="ik trash-2 ik-trash-2"></i>
              </a>
            </div>
        </td>
    </tr>
      @endforeach
    </tbody>
    <tfoot>
      <tr>
        <td colspan="6" class="text-right">
          <h6>Total Deductions : <span class="text-danger"> {{ $sum }}</span> </h6>
        </td>
      </tr>
    </tfoot>
  </table>
</div>
<!--EndLive Deduction Data-->
