<?php $__env->startSection('title'); ?> Download Payslips <?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
<style type="text/css">
    .overflow-visible{
        overflow: visible !important;
    }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="page-header">
  <div class="row align-items-end">
     <div class="col-lg-8">
        <div class="page-header-title">
           <i class="ik ik-briefcase bg-blue"></i>
           <div class="d-inline">
              <h5>Download Payslips</h5>
              <span>Import Zip.</span>
          </div>
      </div>
  </div>
  <div class="col-lg-4">
    <nav class="breadcrumb-container" aria-label="breadcrumb">
       <ol class="breadcrumb">
          <li class="breadcrumb-item">
             <a href="<?php echo e(route('admin.dashboard')); ?>"><i class="ik ik-home"></i></a>
         </li>
         <li class="breadcrumb-item">
             <a href="<?php echo e(route('admin.payroll.index')); ?>">Payroll</a>
         </li>
         <li class="breadcrumb-item active" aria-current="page">Download</li>
     </ol>
 </nav>
</div>
</div>
</div>

<div class="row">
    <div class="col-md-6 col-sm-12 col-xl-6 offset-md-3 offset-xl-3">

        <div class="widget overflow-visible">
            <div class="progress progress-sm progress-hi-3 hidden">
                <div class="progress-bar bg-info" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>
            </div>
            <div class="widget-body">
                <div class="overlay hidden">
                    <i class="ik ik-refresh-ccw loading"></i>
                    <span class="overlay-text">Downloading...</span>
                </div>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="position">
                        <h5 class="text-secondary">Compressed Format</h5>
                    </div>
                </div>

                
              
      <!-- Here Comes the form-->   
              
              
              <form action="<?php echo e(route('admin.payroll.downloadZip')); ?>" method="POST" >
                 <?php echo csrf_field(); ?>  
                 <!--Error warning if No Payslips Found-->
<?php if(Session::has('warning_no_payslips')): ?>
 <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <i class="fa-regular fa-bell"></i>
        <strong>Hello <?php echo e(Auth::user()->username); ?> !</strong> you have some bad feedbacks, 
       
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
             <?php echo Session::get('warning_no_payslips'); ?>

    </div>
 <?php endif; ?>
<hr>
                    <div class="col-12">
                        <div class="form-group">
                          <label for="year">Year </label><small class="text-danger">*</small>
                          <select class="form-control" id="gender" name="year">
                            <option value="" selected value disabled>-- Select Year --</option>
                            <option value="2022">2022</option>
                            <option value="2023">2023</option>
                            
                            
                          </select>
                          <small class="text-danger err" id="year-err"></small>
                        </div>
                      </div>
                   

                      <div class="col-12">
                        <div class="form-group">
                          <label for="month">Month </label><small class="text-danger">*</small>
                          <select class="form-control" id="gender" name="month">
                            <option value="" selected value disabled>-- Select Month --</option>
                            <option value="January">January</option>
                            <option value="February">February</option>
                            <option value="March">March</option>
                            <option value="April">April</option>
                            <option value="May">May</option>
                            <option value="June">June</option>
                            <option value="July">July</option>
                            <option value="August">August</option>
                            <option value="September">September</option>
                            <option value="October">October</option>
                            <option value="November">November</option>
                            <option value="December">December</option>
                          
                            
                            
                          </select>
                          <small class="text-danger err" id="month-err"></small>
                        </div>                        
                      </div>

    <div class="form-check">
    <input type="checkbox" class="form-check-input" name="dummy" value="1" id="Dummy">
    <label class="form-check-label" for="dummy">Download Dummy Payslips Only</label>
                </div>
    <br><br>
                    <button type="submit" class="btn btn-primary"><i class="ik save ik-save"></i>Submit</button>
                    
                    <a href="<?php echo e(route('admin.payroll.index')); ?>" class="btn btn-light"><i class="ik arrow-left ik-arrow-left"></i> Go to Payroll</a>
                </form>
              
              
              
              <!--Here Ends the form--> 
              
              
              
              
              
              
              
              
              
              
              
              
              
              
              
              
              
              
              
              
              
              
            </div>

        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('admin.layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\COMPANY\HUMAN-RESOURCE\resources\views/admin/payroll/create.blade.php ENDPATH**/ ?>