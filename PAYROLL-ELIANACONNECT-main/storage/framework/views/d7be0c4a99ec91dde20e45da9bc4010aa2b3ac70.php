

<?php $__env->startSection('title'); ?> <?php echo e($admindeduction->title); ?> - Edit Deduction <?php $__env->stopSection(); ?>

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
           <i class="ik ik-file-minus bg-blue"></i>
           <div class="d-inline">
              <h5>Deduction</h5>
              <span>Edit Deduction, Please fill all field correctly.</span>
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
             <a href="<?php echo e(route('admin.admindeduction.index')); ?>">Deduction</a>
         </li>
         <li class="breadcrumb-item">
             <a href="#">Edit</a>
         </li>
         <li class="breadcrumb-item active" aria-current="page"><?php echo e($admindeduction->name); ?></li>
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
                    <span class="overlay-text">Deduction <?php echo e($admindeduction->name); ?> Updating...</span>
                </div>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="Deduction">
                        <h5 class="text-secondary">Edit <?php echo e($admindeduction->name); ?> Deduction</h5>
                    </div>
                </div>

                <form action="<?php echo e($form_update); ?>" method="POST" id="editDeduction">
                    <?php echo method_field('PUT'); ?>
                    <?php echo csrf_field(); ?>
                    <div class="form-group">
                        <label for="name">Name</label><small class="text-danger">*</small>
                        <input type="text" name="name" class="form-control" id="name" placeholder="ex: Standard Deduction" autocomplete="off" value="<?php echo e($admindeduction->name); ?>">
                        <small class="text-danger err" id="name-err"></small>
                    </div>
                    <div class="form-group">
                        <label for="amount">Amount</label><small class="text-danger">*</small>
                        <input type="text" name="amount" class="form-control" id="amount" placeholder="ex: 200.15" autocomplete="off" value="<?php echo e($admindeduction->amount); ?>">
                        <small class="text-danger err" id="amount-err"></small>
                    </div>

                    <?php   

$employees = \App\Employee::where('security_number',"=",Auth::user()->security_number)->get()


?>
                    <div class="form-group">
                        <label for="Employee Name">Employee(s)</label><small class="text-danger">*</small>
                        <select class="form-control" name="employee_id" >  
                          <option value=1>For All Employees</option> 
                          <?php $__currentLoopData = $employees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $employee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>    
                                          
                            <option value="<?php echo e($employee->employee_id); ?>">For <?php echo e($employee->first_name); ?> <?php echo e($employee->last_name); ?> - <?php echo e($employee->email); ?></option>                            
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <small class="text-danger err" id="position_id-err"></small>
                      
                      
                      </div>




                    <div class="form-group">
                          <label for="startDate">Deduction Date</label><small class="text-danger">*</small>
                          <input type="text" class="form-control datetimepicker-input" name="start_date" id="start_date" value="<?php echo e($admindeduction->start_date); ?>" data-toggle="datetimepicker" data-target="#start_date" autocomplete="off">
                          <small class="text-danger err" id="start_date-err"></small>
                        </div>


                        <div class="form-check">
    <input type="checkbox" value="recurring" class="form-check-input" name="end_date" value="1" >
    <label class="form-check-label" for="recurring">Check-Mark For Recurring</label>
    
    </div>
    <br><br>
                        <input type="hidden" name="security_number" value="<?php echo e(auth()->user()->security_number); ?>" >
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label for="description">Description</label>
                          <textarea class="form-control" id="description" name="description" placeholder="Some description about Deduction..."><?php echo e(old('description',$admindeduction->description)); ?></textarea>
                          <small class="text-danger err" id="description-err"></small>
                        </div>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-primary"><i class="ik save ik-save"></i>Update</button>

                    <a href="<?php echo e(route('admin.admindeduction.index')); ?>" class="btn btn-light"><i class="ik arrow-left ik-arrow-left"></i> Go Back</a>
                </form>
            </div>

        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script type="text/javascript">
$(document).ready(function($) {
  $("#editDeduction").submit(function(event){
    event.preventDefault();
    editForm("#editDeduction");
  }); 
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\COMPANY\HUMAN-RESOURCE\resources\views/admin/admindeduction/edit.blade.php ENDPATH**/ ?>