@extends('admin.layout.app')

@section('title') Uploading Pension @endsection

@section('css')

@section('content')
<h4>Pension</h4>

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

<form action="{{ route('admin.import_pension') }}" method="POST" enctype="multipart/form-data">
                    @csrf
<div class="shadow-sm p-3 mb-5 bg-white rounded">

<div class="form-group">
    <label for="Upload Statutories - Pension (CSV)">Upload Statutories - Pension</label>
    <input type="file" class="form-control" id="Upload Statutories - Pension (CSV)" name="import_pension">
  </div>

<br> 
<button type="submit" class="btn btn-primary"><i class="ik save ik-save"></i>Submit</button>
  <button type="button" class="btn btn-info"><i class="fa fa-download"></i><a style="color:white" href="{{asset('sample_formats_files/pension.csv')}}">Download Sample Format</a></button>
<a href="{{ route('admin.tax_view') }}" class="btn btn-light"><i class="ik arrow-left ik-arrow-left"></i> Tax Bands</a>
<a href="{{ route('admin.insurance_view') }}" class="btn btn-light"> Insurance <i class="ik arrow-left ik-arrow-right"></i> </a>
</div>

</form>





<!--view Pensions-->

<br><br>
<div class="shadow p-3 mb-5 bg-white rounded">

  <br><br>
  <table id="state_data_table" class="table mb-0 table-hover">
    <thead>
      <tr>
        <th>PENSION NAME</th>
        <th>PENSION PERCENTAGE</th>
        <th>PENSION APPLICABLE ON</th>
        <th>LAST MODIFIED ON</th>
        
        
      </tr>
    </thead>
    <tbody>
      @foreach($pension as $pension)
     
      <tr>
        <td><span><b>{{ $pension->pension_name}} </b></span></td>
        <td><code class="pc">{{ $pension->pension}}%</code></td>
        <td><code class="pc">{{$pension->applied_on }}</code></td>
        <td><code class="pc">{{date('d F-Y',strtotime($pension->updated_at)) }}</code></td>
            
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
<!--End viewing statutories-->



@endsection('content')



