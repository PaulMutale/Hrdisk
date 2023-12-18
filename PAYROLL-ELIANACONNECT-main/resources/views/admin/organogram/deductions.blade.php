@extends('admin.layout.app')

@section('title') Third Party Service Providers @endsection

@section('css')

@section('content')
<h4>Third Party Service Providers (Optional)</h4>
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

<form action="{{ route('admin.import_deductions_csv') }}" method="POST" id="createPosition" enctype="multipart/form-data">
                    @csrf
<div class="shadow-sm p-3 mb-5 bg-white rounded">

<div class="form-group">
    <label for="Upload Deductions (CSV)">Upload Third Party Service Providers - Optional (CSV)</label>
    <input type="file" accept=".csv" class="form-control" id="Upload Deductions (CSV)" name="deductions" required>
  </div>

<br> 
<button type="submit" class="btn btn-primary"><i class="ik save ik-save"></i>Submit</button>
<button type="button" class="btn btn-info"><i class="fa fa-download"></i><a style="color:white" href="{{asset('sample_formats_files/third_party_sample_test.csv')}}">Download Sample Format</a></button>


<a href="{{ route('admin.dashboard') }}" class="btn btn-light">Skip <i class="ik arrow-left ik-arrow-right"></i></a>
</div>

</form>

@endsection('content')