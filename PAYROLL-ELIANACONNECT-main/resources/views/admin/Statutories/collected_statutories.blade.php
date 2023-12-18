@extends('admin.layout.app')

@section('title') Collected Statutories {{$countryName}} @endsection

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
    
    
     $('#state_data').DataTable({
        dom: 'Bfrtip',
        buttons: [
             'pdf','csv', 'excel', 'copy','print'
        ]
    });
    
    
    
     $('#state').DataTable({
        dom: 'Bfrtip',
        buttons: [
             'pdf','csv', 'excel', 'copy','print'
        ]
    });
});
</script>


<!--view Tax-->

<br><br>
<div class="shadow p-3 mb-5 bg-white rounded">
<h4>Collected Tax Bands For {{$countryName}}</h4>
  <br><br>
  <table id="state_data_table" class="table mb-0 table-hover">
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
        <td><span><b>{{ $tax->fb}} @ {{$tax->fbp}}% </b></span></td>
        <td><code class="pc">{{ $tax->sb}} @ {{$tax->sbp}}%</code></td>
        <td><code class="pc">{{ $tax->tb}} @ {{$tax->tbp}}%</code></td>
        <td><code class="pc">{{ $tax->fob}} @ {{$tax->fobp}}%</code></td>      
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
<!--End viewing Tax-->


<!--view Pensions-->

<br><br>
<div class="shadow p-3 mb-5 bg-white rounded">
<h4>Collected Pension Setup For {{$countryName}}</h4>
  <br><br>
  <table id="state_data" class="table mb-0 table-hover">
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

<!--View Insurance-->

<br><br>
<div class="shadow p-3 mb-5 bg-white rounded">
<h4>Collected Insurance Setup For {{$countryName}}</h4>
  <br><br>
  <table id="state" class="table mb-0 table-hover">
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



<br><br>

<div class="shadow-sm p-3 mb-5 bg-white rounded">
<h4>Confirmation</h4>
<p>Please mark the check fields for the collect statutory configurations</p>
<br><br>
<form action="{{ route('admin.confirm_statutories') }}" method="POST" >
                    @csrf

  <div class="form-check">
  <input class="form-check-input" type="checkbox" name="tax" value="tax" id="tax" checked>
  <label class="form-check-label" for="tax">
    Tax Bands
  </label>
</div>
<div class="form-check">
  <input class="form-check-input" type="checkbox" name="pension" value="pension" id="pension" checked>
  <label class="form-check-label" for="pension">
  Pension
  </label>
</div>

<div class="form-check">
  <input class="form-check-input" type="checkbox" name="insurance" value="insurance" id="insurance" checked>
  <label class="form-check-label" for="insurance">
  Insurance
  </label>
</div>
<br><br>
<p>If you feel some statutories are incorrect let us know in the following field. Write in not more than 500 words</p>






<div class="form-group">
    <label for="reasons">Some Reasons for Incorrect Statutories</label>
    <textarea name="reasons" maxlength="500" class="form-control" rows="3"></textarea>
  </div>
<input type="hidden" value="{{$Reference}}" name="Reference" >
<br> 
<button type="submit" class="btn btn-primary"><i class="ik save ik-save"></i>Submit</button>



</form>
</div>
@endsection('content')