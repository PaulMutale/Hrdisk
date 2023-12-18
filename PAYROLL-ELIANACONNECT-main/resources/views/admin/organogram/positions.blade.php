@extends('admin.layout.app')

@section('title') Uploading Company Structure @endsection

@section('css')

@section('content')
<h4>Company Structure</h4>

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

  



<form action="{{ route('admin.import_positions_csv') }}" method="POST" id="createStructure" enctype="multipart/form-data">
                    @csrf
<div class="shadow-sm p-3 mb-5 bg-white rounded">

<div class="form-group">
    <label for="Upload Allowances (CSV)">Upload Positions (CSV)</label>
    <input type="file" accept=".csv" class="form-control" id="Upload Allowances (CSV)" name="positions" required>
  </div>

  <br> 
<button type="submit" class="btn btn-primary"><i class="ik save ik-save"></i>Submit</button>


<button type="info" class="btn btn-info"><i class="fa fa-download"></i><a style="color:white" href="{{asset('sample_formats_files/organogram_sample_test.csv')}}">Download Sample Format</a></button>
</div>
</form>
@endsection('content')