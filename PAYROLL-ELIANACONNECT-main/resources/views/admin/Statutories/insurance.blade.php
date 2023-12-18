@extends('admin.layout.app')

@section('title') Uploading Insurance @endsection

@section('css')

@section('content')
<h4>Insurance</h4>

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

<form action="{{ route('admin.import_insurance') }}" method="POST" enctype="multipart/form-data">
                    @csrf
<div class="shadow-sm p-3 mb-5 bg-white rounded">

<div class="form-group">
    <label for="Upload Statutories - Insurance (CSV)">Upload Statutories - Insurance</label>
    <input type="file" class="form-control" id="Upload Statutories - Insurance (CSV)" name="import_insurance">
  </div>

<br> 
<button type="submit" class="btn btn-primary"><i class="ik save ik-save"></i>Submit</button>
  <button type="button" class="btn btn-info"><i class="fa fa-download"></i><a style="color:white" href="{{asset('sample_formats_files/insurance.csv')}}">Download Sample Format</a></button>
<a href="{{ route('admin.pension_view') }}" class="btn btn-light"><i class="ik arrow-left ik-arrow-left"></i> Pension</a>
</div>

</form>

<!--view Insurance-->

<br><br>
<div class="shadow p-3 mb-5 bg-white rounded">

  <br><br>
  <table id="state_data_table" class="table mb-0 table-hover">
    <thead>
      <tr>
        <th>INSURANCE NAME</th>
        <th>INSURANCE PERCENTAGE</th>
        <th>INSURANCE APPLICABLE ON</th>
        <th>LAST MODIFIED ON</th>
        
        
      </tr>
    </thead>
    <tbody>
      @foreach($insurance as $insurance)
     
      <tr>
        <td><span><b>{{ $insurance->insurance_name}} </b></span></td>
        <td><code class="pc">{{ $insurance->insurance}}%</code></td>
        <td><code class="pc">{{$insurance->applied_on }}</code></td>
        <td><code class="pc">{{date('d F-Y',strtotime($insurance->updated_at)) }}</code></td>
            
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
<!--End viewing Insurance-->


@endsection('content')