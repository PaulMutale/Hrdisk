@extends('admin.layout.app')

@section('title') Uploading Third Party Service Providers @endsection

@section('css')

@section('content')
<h4>Pay Third Party Service Providers</h4>
<br><br>
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

<form action="{{ route('admin.link_employees_csv') }}" method="POST" id="linkDeductions" enctype="multipart/form-data">
                    @csrf
<div class="shadow-sm p-3 mb-5 bg-white rounded">

<div class="form-group">
    <label for="Upload Linked Employees (CSV)">Upload TPSPs Claims (CSV)</label>
    <input type="file" accept=".csv" class="form-control" id="Upload Linked Employees (CSV)" name="import_employees">
  </div>

<br> 
<button type="submit" class="btn btn-primary"><i class="ik save ik-save"></i>Submit</button>
<button type="button" class="btn btn-info"><i class="fa fa-download"></i><a style="color:white" href="{{asset('sample_formats_files/pay_third_party_sample_test.csv')}}">Download Sample Format</a></button>
<a href="{{ route('admin.dashboard') }}" class="btn btn-light"><i class="ik arrow-left ik-arrow-left"></i> Go Home </a>
</div>

</form>

@endsection('content')