<div class="nav-container">
    <nav id="main-menu-navigation" class="navigation-main">
      
      
      
        <div class="nav-item <?php echo e(request()->routeIs(['admin.dashboard']) ? 'active' : ''); ?>">
          
           <?php if(\App\Admin::where('security_number',"=",Auth::user()->security_number)->first()->branch_name == 0): ?>  
            <a href="<?php echo e(route('admin.dashboard')); ?>"><i class="ik ik-bar-chart-2"></i><span><?php echo e(Auth::user()->username); ?></span></a>
          <?php else: ?>
          
         <?php   
       $branch_status = \App\Admin::where('security_number',"=",Auth::user()->security_number)->first()->branch_name;
       $branch_name = \App\Branches::where('company_id',"=",Auth::user()->security_number)->where('branch_id',"=",$branch_status)->first()->branch_name;


        ?>
         <a href="<?php echo e(route('admin.dashboard')); ?>"><i class="ik ik-bar-chart-2"></i><span><?php echo e($branch_name); ?></span></a>  
          
          <?php endif; ?>
          
        </div>

      
      
      
      
      
      
      
      
        <div class="nav-lavel">Manage Payroll</div>
        
        <div class="nav-item has-sub <?php echo e(request()->routeIs('admin.attendance.*') ? 'active open' : ''); ?>">
            <a href="javascript:void(0)"><i class="ik ik-check-circle"></i><span>Attendance</span> 
            </a>
            <div class="submenu-content">
                <a href="<?php echo e(route('admin.attended')); ?>" class="menu-item <?php echo e(request()->routeIs('admin.attendance.create') ? 'active' : ''); ?>"><i class="ik file-text ik-file-text"></i>List of Attendance</a>
                <a href="<?php echo e(route('admin.attendance.index')); ?>" class="menu-item <?php echo e(request()->routeIs('admin.attendance.index') ? 'active' : ''); ?>"><i class="ik file-text ik-file-text"></i>Approve Attendance</a>
            </div>
        </div>

        



        <div class="nav-item has-sub <?php echo e(request()->routeIs('admin.payroll.*') ? 'active open' : ''); ?>">
            <a href="javascript:void(0)"><i class="ik ik-copy"></i><span>Payslips</span> 
            </a>
            <div class="submenu-content">   
            <a href="<?php echo e(route('admin.import_employees_third_party_deductions')); ?>" class="menu-item <?php echo e(request()->routeIs('admin.import_employees_third_party_deductions') ? 'active' : ''); ?>"><i class="fa fa-plus-circle" style="font-size: 14px;"></i>Link Employees</a>
            <a href="<?php echo e(route('admin.linked_employees')); ?>" class="menu-item <?php echo e(request()->routeIs('admin.linked_employees') ? 'active' : ''); ?>"><i class="ik file-text ik-file-text"></i>Linked employees</a>
                <a href="<?php echo e(route('admin.payroll.index')); ?>" class="menu-item <?php echo e(request()->routeIs('admin.payroll.index') ? 'active' : ''); ?>"><i style="font-size:14px" class="ik ik-dollar-sign"></i>Run Payslips</a>
                <a href="<?php echo e(route('admin.payroll.downloadzip')); ?>" class="menu-item <?php echo e(request()->routeIs('admin.payroll.downloadzip') ? 'active' : ''); ?>"><i style="font-size:14px" class="fa fa-download"></i>Download Payslips</a>
                <a href="<?php echo e(route('admin.export_excel')); ?>" class="menu-item <?php echo e(request()->routeIs('admin.export_excel') ? 'active' : ''); ?>"><i style="font-size:14px" class="ik ik-printer"></i>Payroll Summary</a>
            </div>
        </div>

       

      

        <div class="nav-lavel">Organisation Setup</div>
        <div class="nav-item has-sub <?php echo e(request()->routeIs('admin.allowance.*') ? 'active open' : ''); ?>">
            <a href="javascript:void(0)"><i class="ik file-minus ik-file-minus"></i><span>Organogram</span> 
            
                               
            </a>
            <div class="submenu-content">
                <a href="<?php echo e(route('admin.import_position_file')); ?>" class="menu-item <?php echo e(request()->routeIs('admin.allowance.create') ? 'active' : ''); ?>"><i class="fa fa-upload" style="font-size: 14px;"></i>Upload Structure</a>
                <a href="<?php echo e(route('admin.position.index')); ?>" class="menu-item <?php echo e(request()->routeIs('admin.position.index') ? 'active' : ''); ?>"><i class="ik file-text ik-file-text"></i>List Of Positions</a>
                <a href="<?php echo e(route('admin.position.create')); ?>" class="menu-item <?php echo e(request()->routeIs('admin.position.create') ? 'active' : ''); ?>"><i class="fa fa-plus" style="font-size: 14px;"></i>Manually Add Position</a>
                              
            </div>
        </div>


<style>   
.premiumPlan {
  opacity: 0.5; /* make the div 50% translucent */
  color: #999; /* grey out the text */
  cursor: default; /* make it unclickable */
  pointer-events: none; /* prevent mouse events from firing */
}






.tooltip {
  position: relative;
  display: inline-block;
  cursor: default;
}

.tooltip .tooltiptext {
  visibility: hidden;
  padding: 0.25em 0.5em;
  background-color: black;
  color: #fff;
  text-align: center;
  border-radius: 0.25em;
  white-space: nowrap;
  
  /* Position the tooltip */
  position: absolute;
  z-index: 1;
  top: 100%;
  left: 100%;
  transition-property: visibility;
  transition-delay: 0s;
}

.premiumPlan:hover .tooltiptext {
  visibility: visible;
  transition-delay: 0.3s;
}

</style>




<?php if(Auth::user() && Auth::user()->pricing_plan == 'freePlan'): ?>
        <div class="premiumPlan nav-item has-sub <?php echo e(request()->routeIs('admin.allowance.*') ? 'active open' : ''); ?>">
            <a href="javascript:void(0)"><i class="fa fa-industry" style="font-size: 14px;"></i><span>Branches</span> 
            
               <span title="Total Records" class="badge badge-light text-dark">
                <?php echo e(\App\Branches::where('company_id',"=",Auth::user()->security_number)->count()); ?>

                </span>
                               
            </a>
            <div class="submenu-content">
               <a href="<?php echo e(route('admin.branches.create')); ?>" class="menu-item <?php echo e(request()->routeIs('admin.branches.create') ? 'active' : ''); ?>"><i class="fa fa-upload" style="font-size: 14px;"></i>Add Branches</a>
                <a href="<?php echo e(route('admin.branches.index')); ?>" class="menu-item <?php echo e(request()->routeIs('admin.branches.index') ? 'active' : ''); ?>"><i class="ik file-text ik-file-text"></i>List of Branches</a>
                <a href="<?php echo e(route('admin.branches.switch')); ?>" class="menu-item <?php echo e(request()->routeIs('admin.branches.switch') ? 'active' : ''); ?>"><i class="ik file-text ik-file-text"></i>Switch Branches</a>
                                        
            </div>
        </div>

        <?php else: ?>
        <div class="nav-item has-sub <?php echo e(request()->routeIs('admin.allowance.*') ? 'active open' : ''); ?>">
            <a href="javascript:void(0)"><i class="fa fa-industry" style="font-size: 14px;"></i><span>Branches</span> 
            
               <span title="Total Records" class="badge badge-light text-dark">
                <?php echo e(\App\Branches::where('company_id',"=",Auth::user()->security_number)->count()); ?>

                </span>
                               
            </a>
            <div class="submenu-content">
               <a href="<?php echo e(route('admin.branches.create')); ?>" class="menu-item <?php echo e(request()->routeIs('admin.branches.create') ? 'active' : ''); ?>"><i class="fa fa-upload" style="font-size: 14px;"></i>Add Branches</a>
                <a href="<?php echo e(route('admin.branches.index')); ?>" class="menu-item <?php echo e(request()->routeIs('admin.branches.index') ? 'active' : ''); ?>"><i class="ik file-text ik-file-text"></i>List of Branches</a>
                <a href="<?php echo e(route('admin.branches.switch')); ?>" class="menu-item <?php echo e(request()->routeIs('admin.branches.switch') ? 'active' : ''); ?>"><i class="ik file-text ik-file-text"></i>Switch Branches</a>
                                        
            </div>
        </div>

        <?php endif; ?>

        <div class="nav-item has-sub <?php echo e(request()->routeIs('admin.admindeduction.*') ? 'active open' : ''); ?>">
            <a href="javascript:void(0)"><i class="ik file-minus ik-file-minus"></i><span>Deductions</span> 
               
            </a>
            <div class="submenu-content">
                <a href="<?php echo e(route('admin.admindeduction.create')); ?>" class="menu-item <?php echo e(request()->routeIs('admin.admindeduction.create') ? 'active' : ''); ?>"><i class="ik ik-plus-circle"></i>Add New Deduction</a>
                <a href="<?php echo e(route('admin.admindeduction.index')); ?>" class="menu-item <?php echo e(request()->routeIs('admin.admindeduction.index') ? 'active' : ''); ?>"><i class="ik file-text ik-file-text"></i>List Of Deductions</a>
            </div>
        </div>







        
        <div class="nav-item has-sub <?php echo e(request()->routeIs('admin.deduction.*') ? 'active open' : ''); ?>">
            <a href="javascript:void(0)"><i class="ik file-minus ik-file-minus"></i><span>Third Party</span> 
            
                <span title="Total Records" class="badge badge-light text-dark">
                <?php echo e(\App\Deduction::where('security_number',"=",Auth::user()->security_number)->count()); ?>

                </span>
               
            </a>
            <div class="submenu-content">
                <a href="<?php echo e(route('admin.import_deduction_file')); ?>" class="menu-item <?php echo e(request()->routeIs('admin.import_deduction_file') ? 'active' : ''); ?>"><i class="ik ik-plus-circle"></i>Upload Third-Party</a>
                <a href="<?php echo e(route('admin.deduction.create')); ?>" class="menu-item <?php echo e(request()->routeIs('admin.deduction.create') ? 'active' : ''); ?>"><i class="ik ik-plus-circle"></i>Manually Add Provider</a>
                <a href="<?php echo e(route('admin.deduction.index')); ?>" class="menu-item <?php echo e(request()->routeIs('admin.deduction.index') ? 'active' : ''); ?>"><i class="ik file-text ik-file-text"></i>List Of Providers</a>

               
                
               
            </div>
        </div>




       


       



        <div class="nav-item has-sub <?php echo e(request()->routeIs('admin.schedule.*') ? 'active open' : ''); ?>">
            <a href="javascript:void(0)"><i class="ik clock ik-clock"></i><span>Employees Shifts</span> 
           
                <span title="Total Records" class="badge badge-light text-dark">
               <?php echo e(\App\Schedule::where('security_number',"=",Auth::user()->security_number)->count()); ?>

                </span>
               
            </a>
            <div class="submenu-content">
                <a href="<?php echo e(route('admin.schedule.create')); ?>" class="menu-item <?php echo e(request()->routeIs('admin.schedule.create') ? 'active' : ''); ?>"><i class="ik ik-plus-circle"></i>Add New Schedule</a>
                <a href="<?php echo e(route('admin.schedule.index')); ?>" class="menu-item <?php echo e(request()->routeIs('admin.schedule.index') ? 'active' : ''); ?>"><i class="ik file-text ik-file-text"></i>List Of Schedules</a>
            </div>
        </div>






        



        <div class="nav-item has-sub <?php echo e(request()->routeIs('admin.employee.*') ? 'active open' : ''); ?> <?php echo e(request()->routeIs('admin.overtime.*') ? 'active open' : ''); ?> <?php echo e(request()->routeIs('admin.cashadvance.*') ? 'active open' : ''); ?>">
            <a href="javascript:void(0)"><i class="ik users ik-users"></i><span>Employee Records</span> 
               
                <span title="Total Records" class="badge badge-light text-dark">
                <?php if(Auth::user()->branch_name == 0): ?>
                <?php echo e(\App\Employee::where('security_number',"=",Auth::user()->security_number)->count()); ?>

                <?php else: ?>
               <?php echo e(\App\Employee::where('security_number',"=",Auth::user()->security_number)->where('branch_name',"=",Auth::user()->branch_name)->count()); ?> 
                <?php endif; ?>
                </span>
                
            </a>            
            <div class="submenu-content">
                <a href="<?php echo e(route('admin.employee.create')); ?>" class="menu-item <?php echo e(request()->routeIs('admin.employee.create') ? 'active' : ''); ?>"><i class="ik ik-user-plus"></i>Invite New Employee</a>
                <a href="<?php echo e(route('admin.employee.index')); ?>" class="menu-item <?php echo e(request()->routeIs('admin.employee.index') ? 'active' : ''); ?>"><i class="ik file-text ik-file-text"></i>List Of Employees</a>
                <a href="<?php echo e(route('admin.employee.deleted_employees')); ?>" class="menu-item <?php echo e(request()->routeIs('aadmin.employee.deleted_employees') ? 'active' : ''); ?>"><i class="ik file-text ik-file-text"></i>Terminated Employees</a>
                <a href="<?php echo e(route('admin.overtime.index')); ?>" class="menu-item <?php echo e(request()->routeIs('admin.overtime.*') ? 'active' : ''); ?>"><i class="ik watch ik-watch"></i>Overtime</a>
                <a href="<?php echo e(route('admin.cashadvance.index')); ?>" class="menu-item <?php echo e(request()->routeIs('admin.cashadvance.index') ? 'active' : ''); ?>"><i style="font-size:15px" class="fa fa-credit-card"></i>Salary Advance</a>
                <a href="<?php echo e(route('admin.leave_days.index')); ?>" class="menu-item <?php echo e(request()->routeIs('admin.leave_days.index') ? 'active' : ''); ?>"><i style="font-size:15px" class="fa fa-calendar"></i>Leave Days</a>
                <a href="<?php echo e(route('admin.onLeave.index')); ?>" class="menu-item <?php echo e(request()->routeIs('admin.onLeave.index') ? 'active' : ''); ?>"><i class="fa fa-calendar" style="font-size:15px"></i>Employees on Leave</a>
            </div>
        </div>

        









<!--
        <div class="nav-item has-sub <?php echo e(request()->routeIs('admin.position.*') ? 'active open' : ''); ?>">
            <a href="javascript:void(0)"><i class="ik ik-briefcase"></i><span>Positions</span> 
           
                <span title="Total Records" class="badge badge-light text-dark">
                <?php echo e(\App\Position::where('security_number',"=",Auth::user()->security_number)->count()); ?>

                </span>
               
            </a>
            <div class="submenu-content">
                <a href="<?php echo e(route('admin.position.create')); ?>" class="menu-item <?php echo e(request()->routeIs('admin.position.create') ? 'active' : ''); ?>"><i class="ik ik-plus-circle"></i>Add New Position</a>
                <a href="<?php echo e(route('admin.position.index')); ?>" class="menu-item <?php echo e(request()->routeIs('admin.position.index') ? 'active' : ''); ?>"><i class="ik file-text ik-file-text"></i>List Of Position</a>
            </div>
        </div>
-->  

        

<div class="nav-lavel">Tax Setup</div>
      <div class="nav-item <?php echo e(request()->routeIs('admin.tax_view.*') ? 'active' : ''); ?>">
          <a href="<?php echo e(route('admin.tax_view')); ?>" class="menu-item <?php echo e(request()->routeIs('admin.tax_view') ? 'active' : ''); ?>"><i class="fa fa-upload" style="font-size: 14px;"></i>Upload Tax Bands</a>
                <a href="<?php echo e(route('admin.pension_view')); ?>" class="menu-item <?php echo e(request()->routeIs('admin.pension_view') ? 'active' : ''); ?>"><i class="ik file-text ik-file-text"></i>Upload Pension</a>
                <a href="<?php echo e(route('admin.insurance_view')); ?>" class="menu-item <?php echo e(request()->routeIs('admin.insurance_view') ? 'active' : ''); ?>"><i class="ik file-text ik-file-text"></i>Upload Insurance</a>
                
        </div>     
      
      
      
      
      
        <div class="nav-lavel">Bonus and Awards</div>
       <div class="nav-item <?php echo e(request()->routeIs('admin.bonus.*') ? 'active' : ''); ?>">
           <a href="<?php echo e(route('admin.bonus_view')); ?>" class="menu-item <?php echo e(request()->routeIs('admin.bonus_view') ? 'active' : ''); ?>"><i class="ik file-text ik-file-text"></i>Upload Bonuses</a>
                <a href="<?php echo e(route('admin.achievements_view')); ?>" class="menu-item <?php echo e(request()->routeIs('admin.achievements_view') ? 'active' : ''); ?>"><i class="ik file-text ik-file-text"></i>Upload Monthly Awards </a>
                              
        </div>     
      
      
      
      
      
      
          


       


<div class="nav-lavel">Notifications</div>
   <div class="nav-item <?php echo e(request()->routeIs('admin.profile.*') ? 'active' : ''); ?>">
             <a href="<?php echo e(route('admin.message.create')); ?>" class="menu-item <?php echo e(request()->routeIs('admin.message.create') ? 'active' : ''); ?>"><i class="ik ik-plus-circle"></i>Add New Message</a>
               
        </div>     



       




        <div class="nav-lavel">Site Settings</div>
        <div class="nav-item <?php echo e(request()->routeIs('admin.profile.*') ? 'active' : ''); ?>">
            <a href="<?php echo e(route('admin.profile.index')); ?>"><i class="ik user ik-user"></i><span>My Profile</span></a>
            <a href="<?php echo e(route('admin.policies.create')); ?>" class="menu-item <?php echo e(request()->routeIs('admin.policies.create') ? 'active' : ''); ?>"><i class="ik ik-plus-circle"></i>Add HR Policy</a>
        </div>

        <div class="nav-item">    
            <a href="#" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                <i class="ik log-out ik-log-out" style="cursor:pointer"></i><span >Logout</span>   
            </a>
            <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                <?php echo csrf_field(); ?>
            </form>
        </div>
        
    </nav>
</div><?php /**PATH C:\xampp\htdocs\COMPANY\HUMAN-RESOURCE\resources\views/admin/layout/menu.blade.php ENDPATH**/ ?>