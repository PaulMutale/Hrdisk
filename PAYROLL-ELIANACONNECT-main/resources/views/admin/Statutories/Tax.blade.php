@extends('admin.layout.app')

@section('title') Uploading Statutories @endsection

@section('css')

@section('content')
<h4>Tax Bands</h4>
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
    $('#state_data').DataTable({
        dom: 'Bfrtip',
        buttons: [
             'pdf','csv', 'excel', 'copy','print'
        ]
    });
});
</script>



<form action="{{ route('admin.import_tax') }}" method="POST" enctype="multipart/form-data">
                    @csrf
<div class="shadow-sm p-3 mb-5 bg-white rounded">

<div class="form-group">
    <label for="Upload Statutories (CSV)">Upload Tax (CSV)</label>
    <input type="file" class="form-control" id="Upload Deductions (CSV)" name="import_statutories_payee">
  </div>

<br> 
<button type="submit" class="btn btn-primary"><i class="ik save ik-save"></i>Submit</button>
  <button type="button" class="btn btn-info"><i class="fa fa-download"></i><a style="color:white" href="{{asset('sample_formats_files/tax.csv')}}">Download Sample Format</a></button>
<a href="{{ route('admin.pension_view') }}" class="btn btn-light"> Pension <i class="ik arrow-left ik-arrow-right"></i></a>
</div>

</form>


<!--view Tax-->

<br><br>
<div class="shadow p-3 mb-5 bg-white rounded">

  <br><br>
  <table id="state_data" class="table mb-0 table-hover">
    <thead>
      <tr>
        <th>Tax Band 1</th>
        <th>Tax Band 2 </th>
        <th>Tax Band 3</th>
        <th>Tax Band 4 </th>
        
      </tr>
    </thead>
    <tbody>
      @foreach($Tax as $tax)
      <tr>
        <td><span class="pc"><b>{{ $tax->fb}} @ {{$tax->fbp}}% </b></span></td>
        <td><code class="pc">{{ $tax->sb}} @ {{$tax->sbp}}%</code></td>
        <td><code class="pc">{{ $tax->tb}} @ {{$tax->tbp}}%</code></td>
        <td><code class="pc">{{ $tax->fob}} @ {{$tax->fobp}}%</code></td>      
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
<!--End viewing Tax-->

@endsection('content')





