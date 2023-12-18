<!--data here-->
<div class="tab-content" id="pills-tabContent">
  <div class="tab-pane fade active show" id="live" role="tabpanel" aria-labelledby="pills-timeline-tab">

    <!--Live Overtime Data-->
    <div class="card-header">
      <div class="col-md-3 d-block">
        <button class="btn btn-sm btn-dark float-left" onclick="loading();" id="pdfBtnPrintpayroll"><i class="ik ik-printer"></i> PAYROLL</button>
        
      </div>

          
<!--Calendar strats here--> 

<div class="col-md-6">
        <div class="input-group mb-0">
          <span class="input-group-prepend">
          <label class="input-group-text"><i class="ik ik-calendar"></i></label>
          </span>
          <input type="text" class="form-control form-control-bold text-center" placeholder="From date - To date" id="date">
          <span class="input-group-append">
            <label class="input-group-text"><i class="ik ik-calendar"></i></label>
          </span>
        </div>
      </div>



    </div>
    
    <div class="card-body table-responsive">
        <table id="payroll_data_table" class="table table-striped">
          <thead>
            <tr>
              <th>Employee Details</th>
              <th>Basic</th>
              <th>TPIN</th>
              <th>Cash Advance</th>
              <th>Overtime</th>
              <th>Houry Pay</th>
            </tr>
          </thead>
          <tbody>

          </tbody>
        </table>
    </div>
    <!--End Live Overtime Data-->

  </div>
</div>
<!--End data here-->
<center>
<div>
  <form id="payslipForm">
    
    <input type="hidden" name="date" id="payslip_date_input">
    <br><br>   
    <div class="form-check">
    <input type="checkbox" class="form-check-input" name="share" value="1" id="Share">
    <label class="form-check-label" for="Share"><strong>Share to Employees Portal as a final run</strong></label>
    <br><br>
  </div>
  </form>
  
</div>
</center>
<script type="text/javascript">

// get data from serve ajax

function printForm(formId,btn){
  
  $.ajax({
    url: $(formId),//.data('action'),
    type: "GET",
   // data : new FormData($(formId)[0]),
    processData: false,
    contentType: false,
    beforeSend:function(){
      btn.prop("disabled",true);
    },
    complete : function(){
           btn.prop('disabled',false);
    }
  });
}

$(document).ready(function() {
  
  var crntDate = moment().format('MMMM DD, YYYY');
  var lastDate = moment().subtract(30, 'days').format('MMMM DD, YYYY');
  var date = crntDate - lastDate;
  var datePickerPlug = $('#date').daterangepicker({
    "startDate": lastDate,
    "endDate": crntDate,
    locale: {format: 'MMMM DD, YYYY'},
  });
  

  
  var table = $("table#payroll_data_table").DataTable({
    "processing": true,
    "serverSide": true,
    "pagingType":"full_numbers",
    "pageLength":25,
    "autoWidth": false,
    "lengthMenu": [ [10, 25, 50, 100,-1], [10, 25, 50,100, "All"] ],
    "ajax": {
      "url": "<?php echo e($getDataTable); ?>",
      "type": "POST",
      "data":function( d ) {
        d.date = $("#date").val();
      }
    },
    "columnDefs": [
    {
      'targets': [5],
      'searchable':false,
      'orderable':false,
      "className": "text-left"
    }
    ],
    "columns":[
    {"data":"employee"},
    {"data":"basic"},
    {"data":"tpin"},
    {"data":"cash_advance"},
    {"data":"overtime"},
    {"data":"rate_per_hour"},
    ],
    
   'dom': 'Bfrtip',
      buttons: [
                   {
                       extend: 'pdf',
                       exportOptions: {
                           columns: [1,2,3,4,5] // Column index which needs to export
                       }
                   },
                   {
                       extend: 'csv',
                       exportOptions: {
                           columns: [1,2,3,4,5] // Column index which needs to export
                       }
                   },
                   {
                       extend: 'excel',
                       exportOptions: {
                           columns: [1,2,3,4,5] // Column index which needs to export
                       }
                   },
                   {
                       extend: 'print',
                       exportOptions: {
                           columns: [1,2,3,4,5] // Column index which needs to export
                       }
                   },
              ], 
    
    
    
    
    
  });

  var inputDate = $("#date").val();
  
  $("#payslip_date_input").val(inputDate);

  datePickerPlug.on('apply.daterangepicker', function(ev, picker) {
      var date = picker.startDate.format("MMMM DD, YYYY")+" - "+picker.endDate.format("MMMM DD, YYYY");
      $("#payroll_date_input,#payslip_date_input").val(date);
      table.ajax.reload();
  });

  $("#pdfBtnPrintpayslilp,#pdfBtnPrintpayroll").on("click",function(e){
    //var formId = ($(this).attr("id") == "pdfBtnPrintpayslilp") ? "#payslipForm" : "#payrollForm"; 
    
    //window.location = "<?php echo e($payroll_url); ?>";
   
    $.ajax({
            type: 'GET',
            url: "<?php echo e($payslip_url); ?>",
            data: $("#payslipForm").serialize(),
            xhrFields: {
                responseType: 'application/json'
            },
            success: function(response){
              alert(response.message);
              
            },
            error: function(response){
              alert(response.message);
            }
        });





     
        });

     
     //download-payroll







  
});

</script><?php /**PATH C:\xampp\htdocs\COMPANY\HUMAN-RESOURCE\resources\views/admin/payroll/content.blade.php ENDPATH**/ ?>