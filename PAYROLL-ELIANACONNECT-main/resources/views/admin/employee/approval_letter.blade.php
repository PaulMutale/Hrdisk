<!DOCTYPE html>
<html>
<head>
<style>


.img1 {
  float: left;
}

.clearfix::after {
  content: "";
  clear: both;
  display: table;
}
</style>
</head>
<body>

<br><br>
<div>
  <img src="{{asset('LOGOS_UPLOADS/'.Auth::user()->company_logo)}}" class="img-fluid my-5" width="100" height="100" alt="Company Logo"/>  
  <header>       
    <span>
      <address class="return-address">
        {{Auth::user()->username}}<br/>
        {{Auth::user()->company_address}} <br/>
        {{Auth::user()->email}} <br/>
          
      </address>
    </span>
          
    
<time datetime="d mm YYYY">{{date('d F-Y')}}</time> 
</header>
</div>


    <div class="content"> <!-- use this div only if it is required for styling -->
        <p>
          <br><br>

          <br>
          
<br class="salution" />
  
    <h5>
      Dear {{$employee->first_name}},<br>
      <br>
     <u>REF:LETTER OF APPOINTMENT</u>
    </h5>

    We refer to your recent interview for the above-mentioned position and are pleased to inform you that we are going to offer you the position with our company with effect from <strong>{{date('d F-Y')}}</strong> under the following terms and conditions: <br> 
<ul>
  <li>Salary: <strong>ZMW {{$employee->salary}}</strong></li>
  <li>Probationary Period: The probationary period needed to be served by you after joining the job is <strong>3 months</strong>
  </li>
  <li>
    Working Hours: The working hours to be followed by the employee, Monday to Friday working are <string>8 hours</string> , Lunch Break: <strong>13:00 hrs</strong>.

  </li>
  
  <li>
    Notice Period Clause: If the you desire to leave the company, you will need to serve the notice period of <strong>1 Month</strong>


  </li>
  <li>
    Your Annual Bonus will be Key performance indicator based and subject to Management discretion.
  </li>
</ul>
      
Name of the employee: <strong>{{$employee->first_name}} {{$employee->last_name}}</strong><br>
  <br><br><br><br>
Signature:  <img src="{{asset('files/'.$sig)}}" class="img-fluid my-5" width="100" height="100" alt="Employee Signature"/> <br> 
      
For & on behalf of   <strong>{{Auth::user()->username}}</strong> <br> 
Name  <strong>{{Auth::user()->principle_name}}</strong> 
Signature: <strong>{{substr(Auth::user()->principle_name, 0, 1)}}.{{explode(' ',Auth::user()->principle_name)[1]}}</strong>  
  
        
      </p>

  </body>

</html>