@extends('admin.layout.app')

@section('title') Uploading Achievements Bonuses @endsection

@section('css')

@section('content')

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




<h4>Awards and Achievements</h4>

<form action="{{ route('admin.import_achievements') }}" method="POST" enctype="multipart/form-data">
                    @csrf
<div class="shadow-sm p-3 mb-5 bg-white rounded">

<div class="form-group">
    <label for="Upload Bonus (CSV)">Upload Achievements</label>
    <input type="file" class="form-control" id="Upload Bonus (CSV)" name="import_achievements">
  </div>

<br> 
<button type="submit" class="btn btn-primary"><i class="ik save ik-save"></i>Submit</button>
    <button type="button" class="btn btn-info"><i class="fa fa-download"></i><a style="color:white" href="{{asset('sample_formats_files/award.csv')}}">Download Sample Format</a></button>
<a href="{{ route('admin.dashboard') }}" class="btn btn-light"><i class="ik arrow-left ik-arrow-left"></i> Home</a>

</div>

</form>





<!--view Pensions-->

<br><br>
<div class="shadow p-3 mb-5 bg-white rounded">

  <br><br>
  <table id="state_data_table" class="table mb-0 table-hover">
    <thead>
      <tr>
       
        <th>EMPLOYEE ID</th>
        <th>BONUS PERCENTAGE</th>
        <th>BONUS APPLICABLE ON</th>
        <th>TO BE ADDED ON</th>
        <th>LAST MODIFIED ON</th>
        
        
      </tr>
    </thead>
    <tbody>
      @foreach($achievements as $achievement)
     
      <tr>
        
        <td><span><b>{{ $achievement->employee_number}} </b></span></td>
        <td><code class="pc">{{ $achievement->bonus_percentage}}%</code></td>
        <td><code class="pc">{{$achievement->applied_on }}</code></td>
        <td><code class="pc">{{date('d F-Y',strtotime($achievement->to_added_on)) }} Salary</code></td>
        <td><code class="pc">{{date('d F-Y',strtotime($achievement->updated_at)) }}</code></td>
            
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
<!--End viewing statutories-->



@endsection('content')