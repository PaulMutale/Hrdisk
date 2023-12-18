@extends('admin.layout.app')

@section('title') Principal KYC @endsection

@section('css')
<style>
     
    .kbw-signature {
	display: inline-block;
	border: 1px solid #a0a0a0;
	-ms-touch-action: none;
}
.kbw-signature-disabled {
	opacity: 0.35;
}
    
    
        .kbw-signature { width: 100%; height: 200px;}
        #sig canvas{ width: 100% !important; height: auto;}
    










</style>
@endsection('css')

@section('content')


<div class="container">
    <div class="row d-flex justify-content-center align-items-center">
        
            
      
      <br><br>
        <div class="col-12">
<h4>COMPANY PRINCIPAL KYC</h4>
        <div class="progress-wrap">
     <div class="progress-message">Complete the form!</div>  
    <progress max="100" value="0" class="progress" style="width:100%; height: 10px  !important;"></progress>
    </div>
       
<hr>

 <form method="POST" action="{{route('admin.KYC.update')}}" id="form" enctype="multipart/form-data">
    @csrf
  <div class="form-group">
    <label for="name">Principal Person Full Name</label><small class="text-danger">*</small>
    <input type="text" class="form-control" name="principle_name" id="name" required>
  </div>
  <div class="form-group">
    <label for="last-name">Principal Email Address</label><small class="text-danger">*</small>
    <input type="text" class="form-control" name="principle_email" id="email" required>
  </div>
  <div class="form-group">
    <label for="surname">City</label><small class="text-danger">*</small>
    <input type="text" class="form-control" name="principle_city" id="city" required>
  </div>
  <div class="form-group">
    <label for="surname">Province/State</label><small class="text-danger">*</small>
    <input type="text" class="form-control" name="principle_province" id="province" required>
  </div>
  <div class="form-group">
    <label for="surname">National ID</label><small class="text-danger">*</small>
    <input type="file" accept="application/pdf" class="form-control" name="principle_nrc" id="nrc" required>
  </div>
  <div class="form-group">
    <label for="surname">Passport Photo</label><small class="text-danger">*</small>
    <input type="file" accept="image/jpeg,image/png" class="form-control" name="principle_passport_photo" id="nrc" required>
  </div>
  <div class="form-group">
    <label for="surname">Company Certificates</label>
    <input type="file" accept="application/pdf" class="form-control" name="company_pacra" id="company_pacra" >
  </div>
 
  <div class="progress-wrap">
     <div class="progress-message"></div>  
    <progress max="100" value="0" class="progress" style="width:100%; height: 10px  !important;"></progress>
    </div>
    <br>
  <button class="btn btn-success">Submit</button>
</form>




<script> 
    $('#form').on('keyup change paste', 'input, select', function(){
    
    var numValid = 0;
    $("#form input[required], #form select[required]").each(function() {
        if (this.validity.valid) {
            numValid++;
        }
    });
    
    var progress = $(".progress"),
        progressMessage = $(".progress-message");
    
    if (numValid == 0) {
        progress.attr("value", "0");
        progressMessage.text("Complete the form!");
    }
    if (numValid == 1) {
        progress.attr("value", "14");
        progressMessage.text("There you go, great start!");
    }
    if (numValid == 2) {
        progress.attr("value", "28");
        progressMessage.text("Continue, you are doing great");
    }
    if (numValid == 3) {
        progress.attr("value", "42");
        progressMessage.text("You are almost half done");
    }
    if (numValid == 4) {
        progress.attr("value", "56");
        progressMessage.text("Incredible, above average");
    }
    if (numValid == 5) {
        progress.attr("value", "70");
        progressMessage.text("You are winding up now");
    }
    if (numValid == 6) {
        progress.attr("value", "98");
        progressMessage.text("SO CLOSE.");
    }
    if (numValid == 7) {
        progress.attr("value", "100");
        progressMessage.text("Congratulations you are done.");
    }
    
    });
    
    </script>
    
    
    </body>
</html>



        </div>
    </div>
</div>
@endsection
@section('js')
<script>
   var currentTab = 0;
              document.addEventListener("DOMContentLoaded", function(event) {


              showTab(currentTab);

              });

              function showTab(n) {
              var x = document.getElementsByClassName("tab");
              x[n].style.display = "block";
              if (n == 0) {
              document.getElementById("prevBtn").style.display = "none";
              } else {
              document.getElementById("prevBtn").style.display = "inline";
              }
              if (n == (x.length - 1)) {
              document.getElementById("nextBtn").innerHTML = '<i class="fa fa-angle-double-right"></i>';
              } else {
              document.getElementById("nextBtn").innerHTML = '<i class="fa fa-angle-double-right"></i>';
              }
              fixStepIndicator(n)
              }

              function nextPrev(n) {
              var x = document.getElementsByClassName("tab");
              if (n == 1 && !validateForm()) return false;
              x[currentTab].style.display = "none";
              currentTab = currentTab + n;
              if (currentTab >= x.length) {
            
              document.getElementById("nextprevious").style.display = "none";
              document.getElementById("all-steps").style.display = "none";
              document.getElementById("register").style.display = "none";
              document.getElementById("text-message").style.display = "block";




              }
              showTab(currentTab);
              }

              function validateForm() {
                   var x, y, i, valid = true;
                   x = document.getElementsByClassName("tab");
                   y = x[currentTab].getElementsByTagName("input");
                   for (i = 0; i < y.length; i++) {
                       if (y[i].value == "") {
                           y[i].className += " invalid";
                           valid = false;
                       }


                   }
                   if (valid) {
                       document.getElementsByClassName("step")[currentTab].className += " finish";
                   }
                   return valid;
               }

               function fixStepIndicator(n) {
                   var i, x = document.getElementsByClassName("step");
                   for (i = 0; i < x.length; i++) {
                       x[i].className = x[i].className.replace(" active", "");
                   }
                   x[n].className += " active";
               }
</script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script> 
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>
<script type="text/javascript" src="{{asset('esig.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui-touch-punch/0.2.3/jquery.ui.touch-punch.min.js" integrity="sha512-0bEtK0USNd96MnO4XhH8jhv3nyRF0eK87pJke6pkYf3cM0uDIhNJy9ltuzqgypoIFXw3JSuiy04tVk4AjpZdZw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>  
<script type="text/javascript">
    var sig = $('#sig').signature({syncField: '#signature', syncFormat: 'PNG'});
    $('#clear').click(function(e) {
        e.preventDefault();
        sig.signature('clear');
        $("#signature").val('');
    });













    $('#regForm').on('keyup change paste', 'input, select', function(){
    
    var numValid = 0;
    $("#regForm input[required], #regForm select[required]").each(function() {
        if (this.validity.valid) {
            numValid++;
        }
    });
    
    var progress = $(".progress"),
        progressMessage = $(".progress-message");
    
    if (numValid == 0) {
        progress.attr("value", "0");
        progressMessage.text("Complete the form.");
    }
    if (numValid == 1) {
        progress.attr("value", "20");
        progressMessage.text("There you go, great start!");
    }
    if (numValid == 2) {
        progress.attr("value", "40");
        progressMessage.text("Nothing can stop you now.");
    }
    if (numValid == 3) {
        progress.attr("value", "60");
        progressMessage.text("You're basically a hero, right?");
    }
    if (numValid == 4) {
        progress.attr("value", "80");
        progressMessage.text("They are going to write songs about you.");
    }
    if (numValid == 5) {
        progress.attr("value", "95");
        progressMessage.text("SO CLOSE.");
    }
    
    });
    
</script>
@endsection('js')