@php
<div class="nav-item {{ request()->routeIs(['admin.payroll.*']) ? 'active' : '' }}">
            <a href="javascript:void(0)"><i class="ik ik-dollar-sign"></i><span>Payroll</span> 
            </a>
            <div class="submenu-content">
                <a href="{{ route('admin.payroll.index') }}" class="menu-item {{ request()->routeIs('admin.attendance.create') ? 'active' : '' }}"><i class="ik ik-plus-circle"></i>Run Payroll</a>
                <a href="{{ route('admin.payroll.index') }}" class="menu-item {{ request()->routeIs('admin.attendance.index') ? 'active' : '' }}"><i class="ik file-text ik-file-text"></i>Download Payslips</a>
            </div>
        </div>

    $errors = Session::get('error');
    $messages = Session::get('success');
    $info = Session::get('info');
    $warnings = Session::get('warning');
@endphp
@if ($errors) @foreach($errors as $key => $value)
    <div class="alert alert-danger alert-dismissible bg-danger" role="alert">
        <button class="close" type="button" data-dismiss="alert">×</button>
        <strong class="text-white">Error!</strong> {{ $value }}
    </div>
@endforeach @endif

@if ($messages) @foreach($messages as $key => $value)
    <div class="alert alert-success alert-dismissible bg-success" role="alert">
        <button class="close" type="button" data-dismiss="alert">×</button>
        <strong class="text-white">Success!</strong> {{ $value }}
    </div>
@endforeach @endif

@if ($info) @foreach($info as $key => $value)
    <div class="alert alert-info alert-dismissible bg-info" role="alert">
        <button class="close" type="button" data-dismiss="alert">×</button>
        <strong class="text-white">Info!</strong> {{ $value }}
    </div>
@endforeach @endif

@if ($warnings) @foreach($warnings as $key => $value)
    <div class="alert alert-warning alert-dismissible bg-warning" role="alert">
        <button class="close" type="button" data-dismiss="alert">×</button>
        <strong class="text-white">Warning!</strong> {{ $value }}
    </div>
@endforeach @endif