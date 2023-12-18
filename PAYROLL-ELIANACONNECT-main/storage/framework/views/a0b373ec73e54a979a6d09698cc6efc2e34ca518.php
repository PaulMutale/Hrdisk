<table>
    <thead>
      <?php 
     $Insurance = \App\Insurance::where('security_number',"=",Auth::user()->security_number)->first();
     $Pension = \App\pension::where('security_number',"=",Auth::user()->security_number)->first();
    ?>
    <tr>
        <th>Provider Ic</th>
        <th>Reciever Msisdn*</th>
        <th>Names</th>
        <th>EmployeeID</th>
        <th>Year</th>
        <th>NET</th>
        <th><?php echo e(is_null($Insurance) ? INSURANCE : $Insurance->insurance_name); ?></th>
        <th><?php echo e(is_null($Pension) ? PENSION : $Pension->pension_name); ?></th>
        <th>TAX</th>
        <th>TPIN</th>
        <th>Remarks</th>
        <th>Payer Wallet Type id*(N-Normal/S-Salary)</th>
    </tr>
    </thead>
    <tbody>
    <?php $__currentLoopData = $payslip; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payslips): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><?php echo e(Auth::user()->airtel_bulk_payments_ic_number); ?></td>
            <td><?php echo e(preg_replace('/^0/','',str_replace('-','',$payslips->phone))); ?></td>
            <td><?php echo e($payslips->employee_name); ?></td>
            <td><?php echo e($payslips->employee_id); ?></td>
            <td><?php echo e($payslips->monthYear); ?></td>
            <td><?php echo e($payslips->net); ?></td>
            <td><?php echo e($payslips->nhima); ?></td>
            <td><?php echo e($payslips->napsa); ?></td>
            <td><?php echo e($payslips->payee); ?></td>
            <td><?php echo e($payslips->tpin); ?></td>
            <td><?php echo e(date('F Y')); ?> Salary</td>
            <td>S</td>
        </tr> 
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table><?php /**PATH C:\xampp\htdocs\COMPANY\HUMAN-RESOURCE\resources\views/admin/payroll/export/toExcel.blade.php ENDPATH**/ ?>