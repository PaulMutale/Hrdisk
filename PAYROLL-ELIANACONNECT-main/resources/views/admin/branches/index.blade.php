@extends('admin.layout.app')

@section('title') Create a New Branch @endsection

@section('css')
<style type="text/css">
    .overflow-visible{
        overflow: visible !important;
    }
</style>
@endsection

@section('content')



<div class="page-header">
  <div class="row align-items-end">
     <div class="col-lg-8">
        <div class="page-header-title">
           <i class="ik ik-briefcase bg-blue"></i>
           <div class="d-inline">
              <h5>Create</h5>
              <span>Add a Company Branch.</span>
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
             <a href="{{ route('admin.branches.create') }}">Add a Branch</a>
         </li>
         <li class="breadcrumb-item active" aria-current="page">Create</li>
     </ol>
 </nav>
</div>
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
      <th width="35" class="text-center">No</th>
        <th width="35" class="text-center">Branch Name</th>
        <th width="10" class="text-center">Branch Location</th>
        <th width="5">Actions</th>
        
      </tr>
    </thead>
    <tbody>
      @foreach($branches as $branch)
      <tr>
        <td class="text-center">
          {{ ($loop->index + 1) }}
        </td>
        <td>
          <div class="text-center">
            <span><b>{{ $branch->branch_name }}</b></span>
            
          </div>
        </td>
        <td class="text-center">
          <span> {{ $branch->branch_location }}</b></span>
        </td>
       
        <td>
            <div class="btn-group btn-sm" role="group" aria-label="Basic example">
              <a href="{{ route('admin.branches.edit',['id'=>$branch->branch_id]) }}" type="button" class="btn btn-sm btn-outline-primary">
                <i class="ik edit-2 ik-edit-2"></i>
              </a>
              <a onclick="return confirm('Are you sure?')" href="{{ route('admin.branches.destroy',['id'=>$branch->branch_id]) }}" type="button" class="btn btn-sm btn-outline-danger ">
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
          
        </td>
      </tr>
    </tfoot>
  </table>
</div>









@endsection

@section('js')
<script type="text/javascript">
$(document).ready(function($) {
  $("#createPosition").submit(function(event){
    event.preventDefault();
    createForm("#createPosition");
  });
});
</script>
@endsection