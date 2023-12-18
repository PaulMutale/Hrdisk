<?php

namespace App\Http\Controllers\Admin;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\{Deduction,Position,Allowance,Employee,Schedule,PayrollRecords};
use Auth;

class DashboardController extends Controller
{
// Check if the principle has completed the KYC
public function __construct()
{
	$this->middleware('hasKYCBeenDone?', ['except' => 'admin.KYC.index']);
}


    private $folder = "admin.";

    public function dashboard()
    {

$total_employees = Employee::where('security_number',"=",Auth::user()->security_number)->count();
$total_head_count = Position::where('security_number',"=",Auth::user()->security_number)->sum('head_count');
$total_vacancies = Position::where('security_number',"=",Auth::user()->security_number)->sum('vacancies');

$housing_allowances = Position::where('security_number',"=",Auth::user()->security_number)->sum('housing_allowance');
$transport_allowances = Position::where('security_number',"=",Auth::user()->security_number)->sum('transport_allowance');
$total_deductions = Deduction::where('security_number',"=",Auth::user()->security_number)->sum('amount');

$total_net = PayrollRecords::whereYear('created_at',"=",date('Y'))->whereMonth('created_at',"=",date('m'))->where('security_number',"=",Auth::user()->security_number)->sum('net');
$yearly_net = PayrollRecords::whereYear('created_at',"=",date('Y'))->where('security_number',"=",Auth::user()->security_number)->sum('net');      

$total_net = number_format($total_net,2);
$yearly_net = number_format($yearly_net,2);
      
$total_runs = PayrollRecords::whereYear('created_at',"=",date('Y'))->whereMonth('created_at',"=",date('m'))->where('security_number',"=",Auth::user()->security_number)->count();


$nhima = PayrollRecords::whereYear('created_at',"=",date('Y'))->whereMonth('created_at',"=",date('m'))->where('security_number',"=",Auth::user()->security_number)->sum('nhima');
$napsa = PayrollRecords::whereYear('created_at',"=",date('Y'))->whereMonth('created_at',"=",date('m'))->where('security_number',"=",Auth::user()->security_number)->sum('napsa');
$payee = PayrollRecords::whereYear('created_at',"=",date('Y'))->whereMonth('created_at',"=",date('m'))->where('security_number',"=",Auth::user()->security_number)->sum('payee');

$total_allowances = $housing_allowances + $transport_allowances;

		$chartPie = (new LarapexChart)->pieChart()
		->setSubtitle('Setup')
		->addData([$total_employees,$total_employees, $total_employees]) // For Certain Number of Employees 
		->setLabels(["Employees $total_employees","Vacancies $total_vacancies", "Head Count (PENDING) $total_head_count"]);



		

		$chartAllowances = (new LarapexChart)->donutChart()
		->setTitle('Allowances & Deductions')
		->setSubtitle('Setup')
		->addData([$total_employees,$total_employees]) // For Certain Employees
		->setLabels(["Allowances ZMW $total_allowances","Deductions ZMW $total_deductions"]);

		

		$chartNet = (new LarapexChart)->pieChart()
		->setTitle('Net Pays - Year to Date ')
		->setSubtitle('Setup')
		->addData([$total_net,$yearly_net]) // For Certain Employees
		->setLabels(["Current Month - ZMW $total_net","Previous Months - ZMW  $yearly_net",]);

// Trial   
$charts = (new LarapexChart)->donutChart()
->setTitle('Statutories - Year to Date')
		->setSubtitle('Setup')
		->addData([$total_employees,$total_employees, $total_employees]) // For Certain Number of Employees 
		->setLabels(["PAYEE ZMW $payee","NHIMA ZMW $nhima", "NAPSA ZMW $napsa"]);


		//$chartStat = (new LarapexChart)->donutChart()
		//->setTitle('Statutories.')
		//->setSubtitle('Setup.')
		//->addData([11,12, 12])
		//->setLabels(["PAYEE ZMW $payee","NHIMA ZMW $nhima", "NAPSA ZMW $napsa"]);


		
    	return View($this->folder."dashboard.dashboard",[
			'allowances'=> Position::where('security_number',"=",Auth::user()->security_number)->latest('id')->get(),
			'total_allowance'=> $total_allowances,
    		'deductions'=> Deduction::where('security_number',"=",Auth::user()->security_number)->latest('id')->get(),
    		'total_deduction' => $total_deductions,
    		'positions'=> Position::where('security_number',"=",Auth::user()->security_number)->inRandomOrder()->get(),
			'total_positions'=> Position::where('security_number',"=",Auth::user()->security_number)->count(),
			'employees'=> Employee::where('security_number',"=",Auth::user()->security_number)->inRandomOrder()->get(),
			'total_employees'=> $total_employees,
			'total_schedules'=> Schedule::where('security_number',"=",Auth::user()->security_number)->count(),
			'chartPie' => $chartPie,
			'chartAllowances' => $chartAllowances,
			'chartNet' => $chartNet,
			'chartStat' => $charts,
			
    	]);
    }

}
