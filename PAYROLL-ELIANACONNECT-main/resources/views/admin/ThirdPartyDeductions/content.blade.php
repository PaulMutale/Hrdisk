@extends('admin.layout.app')

@section('title') Third Party @endsection

@section('css')
<style type="text/css">
    .overflow-visible{
        overflow: visible !important;
    }
    td.p-0 img.img-thumbnail{
      width: 140px;
    }
    button.h-33{
      height: 33px !important;
    }
</style>
@endsection

@section('content')

<div class="page-header">
  <div class="row align-items-end">
    <div class="col-lg-8">
      <div class="page-header-title">
        <i class="ik ik-at-sign bg-blue"></i>
        <div class="d-inline">
          <h5>Extracts Payable to Third Party Service Providers</h5>
          <span>You can show and manage third party extracts here</span>
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
            <a href="{{ route('admin.cashadvance.index') }}">Third Party Services</a>
          </li>
          <li class="breadcrumb-item active" aria-current="page">List of Added Employees</li>
        </ol>
      </nav>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-12 col-md-12 mt-4">
      <div class="card">

        <!--Tab content-->
        <div class="loader br-4 hidden">
          <i class="ik ik-refresh-cw loading"></i>
          <span class="loader-text">Data Fetching....</span>
        </div>
        <div class="tabs_contant">
          <div class="card-header">
            <h5>List of Added Employees</h5>
          </div>
          <div class="card-body">
              



          <div class="tab-content" id="pills-tabContent">
  <div class="tab-pane fade active show" id="live" role="tabpanel" aria-labelledby="pills-timeline-tab">

   

    <div class="card-body table-responsive">
        <table id="linked_employees_data_table" class="table table-striped">
          <thead>
            <tr>
              <th>No</th>
              <th>Employee ID</th>
              <th>Employee Name</th>
              <th>Amount</th>              
              <th>Name</th>
              <th>Code</th>
              <th>Due on</th>
              <th>Action</th>
                            
            </tr>
          </thead>
          <tbody>
          <tbody>
        

          </tbody>
        </table>
    </div>
    <!--End Live Cash Advance Data-->

  </div>
</div>








          
          </div>
        </div>
        <!--End Tab Content-->
      </div>
    </div>
  </div>
  
</div>









<!--data here-->

<!--End data here-->
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript">
  $(document).ready(function(){






    $("#linked_employees_data_table").DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('admin.linked_employees_getDataTable') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'employee_id', name: 'employee_id'},
            {data: 'employee_name', name: 'employee_name'},
            {data: 'amount', name: 'amount'},
            {data: 'deduction_name', name: 'deduction_name'},
            {data: 'deduction_code', name: 'deduction_code'},
            {data: 'date', name: 'date'},
            {data: 'action', name: 'action', 
                orderable: true, 
                searchable: true
            },
        ],
        
        
        
        'dom': 'Bfrtip',
      buttons: [
                   {
                       extend: 'pdf',
                       exportOptions: {
                           columns: [0,1,2,3,4,5,6] // Column index which needs to export
                       }
                   },
                   {
                       extend: 'csv',
                       exportOptions: {
                           columns: [0,1,2,3,4,5,6] // Column index which needs to export
                       }
                   },
                   {
                       extend: 'excel',
                       exportOptions: {
                           columns: [0,1,2,3,4,5,6] // Column index which needs to export
                       }
                   },
                   {
                       extend: 'print',
                       exportOptions: {
                           columns: [0,1,2,3,4,5,6] // Column index which needs to export
                       }
                   },
              ],
    })
  });



 
</script>



