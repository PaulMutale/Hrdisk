<table>
    <thead>
      @php 
     $Insurance = \App\Insurance::where('security_number',"=",Auth::user()->security_number)->first();
     $Pension = \App\pension::where('security_number',"=",Auth::user()->security_number)->first();
    @endphp
    <tr>
        <th>Provider Ic</th>
        <th>Reciever Msisdn*</th>
        <th>Names</th>
        <th>EmployeeID</th>
        <th>Year</th>
        <th>NET</th>
        <th>{{is_null($Insurance) ? INSURANCE : $Insurance->insurance_name}}</th>
        <th>{{is_null($Pension) ? PENSION : $Pension->pension_name}}</th>
        <th>TAX</th>
        <th>TPIN</th>
        <th>Remarks</th>
        <th>Payer Wallet Type id*(N-Normal/S-Salary)</th>
    </tr>
    </thead>
    <tbody>
    @foreach($payslip as $payslips)
        <tr>
            <td>{{Auth::user()->airtel_bulk_payments_ic_number}}</td>
            <td>{{preg_replace('/^0/','',str_replace('-','',$payslips->phone))}}</td>
            <td>{{$payslips->employee_name}}</td>
            <td>{{$payslips->employee_id}}</td>
            <td>{{$payslips->monthYear}}</td>
            <td>{{$payslips->net}}</td>
            <td>{{$payslips->nhima}}</td>
            <td>{{$payslips->napsa}}</td>
            <td>{{$payslips->payee}}</td>
            <td>{{$payslips->tpin}}</td>
            <td>{{date('F Y')}} Salary</td>
            <td>S</td>
        </tr> 
    @endforeach
    </tbody>
</table>