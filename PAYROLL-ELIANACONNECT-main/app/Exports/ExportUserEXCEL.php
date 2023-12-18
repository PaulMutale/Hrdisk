<?php

namespace App\Exports;

use App\Employee;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Auth;

class ExportUserEXCEL implements FromView, ShouldAutoSize
{
    public function view(): View
    {
        
        return view('admin.employee.downloadEmployees', [
        'employees' => Employee::where('security_number',"=",Auth::user()->security_number)->get()
        ]);
    }
    /**
     *
     * @return array
     */

/*
    public function startCell(): string
    {
        return 'A2';
    }
    */
    /**
     */
}
