<?php

namespace App\Exports;

use App\PayrollRecords;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Auth;

class ExportUser implements FromView, ShouldAutoSize
{
    public function view(): View
    {
        $year = date('Y');
        $month = date('m');

        return view('admin.payroll.export.toExcel', [
            'payslip' => PayrollRecords::whereMonth('created_at', $month)->whereYear('created_at', $year)->where('security_number',"=",Auth::user()->security_number)->get()
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
