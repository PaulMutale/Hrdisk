<html lang="en">
<head>
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-LVHG5QKYWJ"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-LVHG5QKYWJ');
</script> 
  
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>E-SYSTEM CONNECT::HOME &mdash; HR PAYROLL MANAGEMENT SYSTEM</title>
  <meta name="description" content="This is the cloud based  Payroll Management System developed by Eliana Connect which is an integral part of any business and it is an important HR / accounting  function that needs to be handled with the utmost caution and confidentiality.  The main functions of this payroll system will be to run the payroll for all employees and compile their payslips in PDF Formats." />
<meta name="author" content="https://elianaconnect.com" />
  <link rel="stylesheet" href="{{asset('landing_page/css/style.css')}}">
  <!-- Favicons -->
  <link href="{{asset('landing_assets/img/fav.PNG')}}" rel="icon">
  <link href="{{asset('landing_assets/img/apple-touch-icon.PNG')}}" rel="apple-touch-icon">

  <style>
* {
  box-sizing: border-box;
}

.columns {
  float: left;
  width: 33.3%;
  padding: 8px;
}

.price {
  list-style-type: none;
  border: 1px solid #eee;
  margin: 0;
  padding: 0;
  -webkit-transition: 0.3s;
  transition: 0.3s;
}

.price:hover {
  box-shadow: 0 8px 12px 0 rgba(0,0,0,0.2)
}

.price .header {
  background-color: #111;
  color: white;
  font-size: 25px;
}

.price li {
  border-bottom: 1px solid #eee;
  padding: 20px;
  text-align: center;
}

.price .grey {
  background-color: #eee;
  font-size: 20px;
}

.button {
  background-color: #04AA6D;
  border: none;
  color: white;
  padding: 10px 25px;
  text-align: center;
  text-decoration: none;
  font-size: 18px;
}

@media only screen and (max-width: 600px) {
  .columns {
    width: 100%;
  }
}
</style>


</head>
<body>

  <div class="js-animsition animsition" id="site-wrap" data-animsition-in-class="fade-in" data-animsition-out-class="fade-out">

@include('sweetalert::alert')
    <header class="templateux-navbar" role="banner">

      <div class="container"  data-aos="fade-down">
        <div class="row">

          <div class="col-3 templateux-logo">
             <img src="{{asset('landing_assets/img/logo1.PNG')}}" alt="E-SYSTEMS" class="img-fluid" style="width:80px; height:80px; border-radius:100%">
          </div>
          <nav class="col-9 site-nav">
            <button class="d-block d-md-none hamburger hamburger--spin templateux-toggle templateux-toggle-light ml-auto templateux-toggle-menu" data-toggle="collapse" data-target="#mobile-menu" aria-controls="mobile-menu" aria-expanded="false" aria-label="Toggle navigation">
              <span class="hamburger-box">
                <span class="hamburger-inner"></span>
              </span>
            </button> <!-- .templateux-toggle -->

            <ul class="sf-menu templateux-menu d-none d-md-block">
              <li class="active">
                <a target="_blank" href="https://elianaconnect.gitbook.io/product-docs/" class="animsition-link">Docs</a>
              </li>
              <li class="active">
                <a href="{{route('register')}}" class="animsition-link">Get Started</a>
              </li>
              <li class="active">
                <a href="{{route('pricing')}}" class="animsition-link">Pricing</a>
              </li>
			  <li class="active">
                <a href="{{route('login')}}" class="animsition-link">Employer Login</a>
              </li>
			  <li class="active">
                <a href="{{'login_view'}}" class="animsition-link">Employee Login</a>
              </li>
             
             
              
              <li><a href="{{'contact_us'}}" class="animsition-link">Contact</a></li>
            </ul> <!-- .templateux-menu -->

          </nav> <!-- .site-nav -->
          

        </div> <!-- .row -->
      </div> <!-- .container -->
    </header> <!-- .templateux-navba -->
    
    <div class="templateux-cover" style="background-image: url({{asset('landing_page/images/person_3.jpg')}})">
      <div class="container">
        <div class="row align-items-lg-center">

          <div class="col-lg-6 order-lg-1">
            <h1 class="heading mb-3 text-white" data-aos="fade-up">Affordable<strong> Pricing </strong></h1>
            <p class="lead mb-5 text-white" data-aos="fade-up"  data-aos-delay="100">Pricing tables.</p>
          
            
          </div>
           
        </div>
      </div>
    </div> <!-- .templateux-cover -->



 <!--Pricing Starts here-->  
 
 
 <h2 style="text-align:center">30 day FREE trial with all plans!</h2>
<p style="text-align:center">Our pricing table.</p>

<div class="columns">
  <ul class="price">
    <li class="header">Domestic</li>
    <li class="grey">$1 / month</li>
    <li>2 Staffs</li>
    <li>All plans have unlimited features</li>
    <li class="grey"><a href="{{route('register')}}" class="button">Sign Up</a></li>
  </ul>
</div>

<div class="columns">
  <ul class="price">
    <li class="header" style="background-color:#04AA6D">Business</li>
    <li class="grey">$ 4.99 / month</li>
    <li>10 Employees</li>
    <li>All plans have unlimited features</li>   
    <li class="grey"><a href="{{route('register')}}" class="button">Sign Up</a></li>
  </ul>
</div>

<div class="columns">
  <ul class="price">
    <li class="header">Company</li>
    <li>Unlimited Employees</li>
    <li class="grey">$ 13.99 / month</li>
    <li>All plans have unlimited features</li>
    <li class="grey"><a href="{{route('register')}}" class="button">Sign Up</a></li>
  </ul>
</div>

 <br><br>
 
 
 
<!--Pricing Ends here-->



<footer class="templateux-footer bg-light">
  <br><br><br>
  <div class="container">

    <div class="text-center">
      <div class="text-center"><p>
        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
        Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This site is powered with <i class="text-danger icon-heart" aria-hidden="true"></i> by <a href="https://elianaconnect.com" target="_blank" class="text-primary">Eliana-connect</a>
        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
      </p></div>
    </div> <!-- .row -->

    
  </div>
</footer> <!-- .templateux-footer -->


</div> <!-- .js-animsition -->


<script src="{{asset('landing_page/js/scripts-all.js')}}"></script>
<script src="{{asset('landing_page/js/main.js')}}"></script>

</body>
</html>