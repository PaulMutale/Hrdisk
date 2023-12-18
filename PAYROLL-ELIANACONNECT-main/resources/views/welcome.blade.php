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
  <title>E-SYSTEM CONNECT::HR PAYROLL MANAGEMENT SYSTEM</title>
  <meta name="description" content="This is the cloud based  Payroll Management System developed by Eliana Connect which is an integral part of any business and it is an important HR / accounting  function that needs to be handled with the utmost caution and confidentiality.  The main functions of this payroll system will be to run the payroll for all employees and compile their payslips in PDF Formats." />
<meta name="author" content="https://elianaconnect.com" />
  <link rel="stylesheet" href="{{asset('landing_page/css/style.css')}}">
  <!-- Favicons -->
  <link href="{{asset('landing_assets/img/fav.PNG')}}" rel="icon">
  <link href="{{asset('landing_assets/img/apple-touch-icon.PNG')}}" rel="apple-touch-icon">
</head>
<body>

  <div class="js-animsition animsition" id="site-wrap" data-animsition-in-class="fade-in" data-animsition-out-class="fade-out">

@include('sweetalert::alert')
    <header class="templateux-navbar" role="banner">

      <div class="container"  data-aos="fade-down">
        <div class="row">

          <div class="col-1 templateux-logo">
             <img src="{{asset('landing_assets/img/logo1.PNG')}}" alt="E-SYSTEMS" class="img-fluid" style="width:80px; height:80px; border-radius:100%">
          </div>
          <nav class="col-11 site-nav">
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
                <a href="{{route('PricingController/index')}}" class="animsition-link">Get Started</a>
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
              
             
              </li>
                <li class="active">
                <a href="{{'agents_login_view'}}" class="animsition-link">Agent Login</a>
              </li>
              
            <!--
                <li class="active">
                <a href="{{'agents_register_view'}}" class="animsition-link">Agent Registration</a>
              </li>
             -->
             
              
              <li><a href="{{'contact_us'}}" class="animsition-link">Contact</a></li>
            </ul> <!-- .templateux-menu -->

          </nav> <!-- .site-nav -->
          

        </div> <!-- .row -->
      </div> <!-- .container -->
    </header> <!-- .templateux-navba -->
    
    <div class="templateux-cover" style="background-image: url({{asset('landing_page/images/hero_1.jpg')}})">
      <div class="container">
        <div class="row align-items-lg-center">

          <div class="col-lg-6 order-lg-1">
            <h1 class="heading mb-3 text-white" data-aos="fade-up">We Are Your Partners in <strong>Human Resource Management </strong></h1>
            <p class="lead mb-5 text-white" data-aos="fade-up"  data-aos-delay="100">Cloud-Based system built for Automating the Human Resource processes of your company.</p>
          
            
          </div>
           
        </div>
      </div>
    </div> <!-- .templateux-cover -->

    <div class="templateux-section pt-0 pb-0">
      <div class="container">
        <div class="row">
          <div class="col-md-12 templateux-overlap">
            <div class="row">
              <div class="col-md-4" data-aos="fade-up" data-aos-delay="600">
                <div class="media block-icon-1 d-block text-left">
                  <div class="icon mb-3">
                    <img src="{{asset('landing_page/images/flaticon/svg/001-consultation.svg')}}" alt="Image" class="img-fluid">
                  </div>
                  <div class="media-body">
                    <h3 class="h5 mb-4">Record Management</h3>
                    <p>Stores and records all pieces of information related to your employees.</p>
                    <p data-aos="fade-up" data-aos-delay="200"><a href="{{route('register')}}" class="btn btn-primary py-3 px-4 mr-3">Get Started</a></p> 
                  </div>
                </div> <!-- .block-icon-1 -->
              </div>
              <div class="col-md-4" data-aos="fade-up" data-aos-delay="700">
                <div class="media block-icon-1 d-block text-left">
                  <div class="icon mb-3">
                    <img src="{{asset('landing_page/images/flaticon/svg/002-discussion.svg')}}" alt="Image" class="img-fluid">
                  </div>
                  <div class="media-body">
                    <h3 class="h5 mb-4">Employees Payslips</h3>
                    <p>Run the payroll for all employees and compile their payslips in Various Formats</p>
                   <p data-aos="fade-up" data-aos-delay="200"><a href="{{route('register')}}" class="btn btn-primary py-3 px-4 mr-3">Get Started</a></p> 
                  </div>
                </div> <!-- .block-icon-1 -->
              </div>
              <div class="col-md-4" data-aos="fade-up" data-aos-delay="800">
                <div class="media block-icon-1 d-block text-left">
                  <div class="icon mb-3">
                    <img src="{{asset('landing_page/images/flaticon/svg/003-turnover.svg')}}" alt="Image" class="img-fluid">
                  </div>
                  <div class="media-body">
                    <h3 class="h5 mb-4">Employees Portal</h3>
                    <p>Provides a seperate portal for employees making the whole process fully automated</p>
                 <p data-aos="fade-up" data-aos-delay="200"><a href="{{route('register')}}" class="btn btn-primary py-3 px-4 mr-3">Get Started</a></p>    
                  </div>
                </div> <!-- .block-icon-1 -->
              </div>
              
            </div>
          </div>
        </div>
      </div>
    </div> <!-- .templateux-section -->

    <div class="templateux-section">

      <div class="container"  data-aos="fade-up">
        <div class="row">
          <div class="col-lg-7">
            <h2 class="mb-5">E-SYSTEMS</h2>
            <div class="owl-carousel wide-slider">
              <div class="item">
                <img src="{{asset('landing_page/images/slider-1.jpg')}}" alt="Free template by TemplateUX.com" class="img-fluid">
              </div>
              <div class="item">
                <img src="{{asset('landing_page/images/slider-2.jpg')}}" alt="Free template by TemplateUX.com" class="img-fluid">
              </div>
              <div class="item">
                <img src="{{asset('landing_page/images/slider-3.jpg')}}" alt="Free template by TemplateUX.com" class="img-fluid">
              </div>
            </div> <!-- .owl-carousel -->
          </div>
          <div class="col-lg-5 pl-lg-5">
            <h2 class="mb-5">Why this System?</h2>
            <div class="accordion" id="accordionExample">


              <div class="accordion-item">
                <h2 class="mb-0 rounded mb-2">
                  <a href="#" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                  Employee Self Service</a>
                </h2>

                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                  <div class="accordion-body">
                    <p>Give access to your employees to view payslips, request leave, or apply for salary advance within their portal.</p>
                  </div>
                </div>
              </div>
              
              <div class="accordion-item">
                <h2 class="mb-0 rounded mb-2">
                  <a href="#" class="collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                   Payroll Reports
                  </a>
                </h2>
                
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                  <div class="accordion-body">
                    <p>View a wide range of payroll reports to get valuable information on payroll activity, disbursements, remuneration and statutory contributions.

                      </p>
                  </div>
                </div>
              </div>
              
              <div class="accordion-item">
                <h2 class="mb-0 rounded mb-2">
                  <a href="#" class="collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                   Invite Employees
                  </a>
                </h2>
                
                <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                  <div class="accordion-body">
                    <p>Eliminate the admin burden and save time with automated payroll application within the employees portal.</p>
                  </div>
                </div>
              </div>
              
              <div class="accordion-item">
                <h2 class="mb-0 rounded mb-2">
                  <a href="#" class="collapsed" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                    How hrdisk works 
                  </a>
                </h2>

                <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample">
                  <div class="accordion-body">
                    <p>Add hrdisk Payroll to your subscription for $5 a month for up to 10 payroll employees, then $0.5 for each additional employee per month. Sign up to hrdisk free for one month after which the standard charges apply.</p>
                  </div>
                </div>
              </div>
              
            </div>
          </div>
        </div>
      </div>
    </div> <!-- .templateux-section -->
<!--
    <div class="templateux-section bg-light py-5" id="templateux-counter-section">
      <div class="container">
        <div class="row">
          <div class="col-md">
            <div class="templateux-counter text-center">
              <span class="templateux-number" data-number="160">0</span>
              <span class="templateux-label">Number of Clients</span>
            </div>
          </div>
          <div class="col-md">
            <div class="templateux-counter text-center">
              <span class="templateux-number" data-number="10">0</span>
              <span class="templateux-label">Number of Personnel</span>
            </div>
          </div>
          <div class="col-md">
            <div class="templateux-counter text-center">
              <span class="templateux-number" data-number="1">0</span>
              <span class="templateux-label">Years Of Experience</span>
            </div>
          </div>    
        </div>
      </div>
      
    </div>
  </div> 
  -->

  
  <div class="templateux-section">
    <div class="container">
      <div class="row text-center mb-5">
        <div class="col-12">
          <h2>Happy Customers</h2>
        </div>
      </div>
      <div class="row justify-content-center">
        <div class="col-md-8 testimonial-wrap">
          <div class="quote">&ldquo;</div>
          <div class="owl-carousel wide-slider-testimonial">
            <div class="item">
              <blockquote class="block-testomonial">
                <p>&ldquo;Happy with their service, they have Simplied compliance and reporting at CashXpress&rdquo;</p>
                <p><cite>M. Chilufya, COO CashXpress</cite></p>
              </blockquote>
            </div>

           <!--
            <div class="item">
              <blockquote class="block-testomonial">
                <p>&ldquo;A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth.&rdquo;</p>
                <p><cite>Bob Robe, CEO and Founder of Fixer</cite></p>
              </blockquote>
            </div>
          -->
          </div>
        </div>
      </div>
    </div> <!-- .container -->
  </div> <!-- .templateux-section -->

  <div class="templateux-section bg-light">
    <div class="container">
      <div class="row mb-5">
        <div class="col-12 text-center mb-5">
          <h2>Our Services</h2>
        </div>
        <div class="col-md-4 mb-4" data-aos="fade-up">
          <div class="media block-icon-1 d-block text-center">
            <div class="icon mb-3">
              <img src="{{asset('landing_page/images/flaticon/svg/004-gear.svg')}}" alt="Image" class="img-fluid">
            </div>
            <div class="media-body">
              <h3 class="h5 mb-4">Software Packages</h3>
              <p>We offer you first-class products, e.g. for the automated, web-based provision of updates or the construction of your off-site packaging: efficient, and reliable.</p>
            </div>
          </div> <!-- .block-icon-1 -->
        </div>
        <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="100">
          <div class="media block-icon-1 d-block text-center">
            <div class="icon mb-3">
              <img src="{{asset('landing_page/images/flaticon/svg/005-conflict.svg')}}" alt="Image" class="img-fluid">
            </div>
            <div class="media-body">
              <h3 class="h5 mb-4">Service Solutions</h3>
              <p>E-Systems facilitates budget planning with standardized IT services at a fixed price—including maintenance, application packaging and software testing.</p>
            </div>
          </div> <!-- .block-icon-1 -->
        </div>
        <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="200">
          <div class="media block-icon-1 d-block text-center">
            <div class="icon mb-3">
              <img src="{{asset('landing_page/images/flaticon/svg/006-meeting.svg')}}" alt="Image" class="img-fluid">
            </div>
            <div class="media-body">
              <h3 class="h5 mb-4">Good Security</h3>
              <p>We provide vehicle tracking softwares that are able to collect and maintain dynamic position of where a vehicle is located, all in real time.</p>
            </div>
          </div> <!-- .block-icon-1 -->
        </div>

        <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="300">
          <div class="media block-icon-1 d-block text-center">
            <div class="icon mb-3">
              <img src="{{asset('landing_page/images/flaticon/svg/007-brainstorming.svg')}}" alt="Image" class="img-fluid">
            </div>
            <div class="media-body">
              <h3 class="h5 mb-4">HR Management</h3>
              <p>These are cloudbased software  services which are an important integral part of any business in HR / accounting  functional services.</p>
            </div>
          </div> <!-- .block-icon-1 -->
        </div>
        <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="400">
          <div class="media block-icon-1 d-block text-center">
            <div class="icon mb-3">
              <img src="{{asset('landing_page/images/flaticon/svg/001-consultation.svg')}}" alt="Image" class="img-fluid">
            </div>
            <div class="media-body">
              <h3 class="h5 mb-4">System DevOps </h3>
              <p>We offer a variety of website design and development services ranging from simple static websites, dynamic websites and E-commerce web applications.</p>
            </div>
          </div> <!-- .block-icon-1 -->
        </div>
        <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="500">
          <div class="media block-icon-1 d-block text-center">
            <div class="icon mb-3">
              <img src="{{asset('landing_page/images/flaticon/svg/009-brainstorming-2.svg')}}" alt="Image" class="img-fluid">
            </div>
            <div class="media-body">
              <h3 class="h5 mb-4">Meeting Videos Guidance</h3>
              <p>This is the daily recurring meeting at 2.00 pm (GMT). The aim of this meeting is to guide and answer queries related to the HRDISK Software.<a style="color:royalblue" href="https://meet.google.com/dri-hhko-xbd">Join Now</a></p>
            </div>
          </div> <!-- .block-icon-1 -->
        </div>

      </div>
      
    </div>
  </div> <!-- .templateux-section -->

  <div class="container templateux-section">
    <div class="row">
      <div class="col-12 col-md-7 mx-auto text-center mb-5">
        <h2>A successful business starts with a successful team.</h2>
        <p>Build an incredible workplace and grow your business with hrdisk.

        </p>
      </div>
    </div>
    <div class="d-flex flex-sm-row">
      <a href="#" class="block-thumbnail-1 one-third" style="background-image: url({{asset('landing_page/images/slider-2.jpg')}})" data-aos="fade">
        <div class="block-thumbnail-content">
          <h2></h2>
          <span class="post-meta"> &bullet; </span>
        </div>
      </a>
	  
      <a href="#" class="block-thumbnail-1 two-third" style="background-image: url({{asset('landing_page/images/slider-1.jpg')}})" data-aos="fade" data-aos-delay="100">
        <div class="block-thumbnail-content">
          <h2></h2>
          <span class="post-meta"> &bullet; </span>
        </div>
      </a>
    </div>
    <div class="d-flex flex-column flex-sm-row">
      <a href="#" class="block-thumbnail-1 two-third" style="background-image: url({{asset('landing_page/images/slider-1.jpg')}})" data-aos="fade" data-aos-delay="200">
        <div class="block-thumbnail-content">
          <h2></h2>
          <span class="post-meta">  &bullet; </span>
        </div>
      </a>
      <a href="#" class="block-thumbnail-1 one-third" style="background-image: url({{asset('landing_page/images/slider-1.jpg')}})" data-aos="fade" data-aos-delay="300">
        <div class="block-thumbnail-content">
          <h2></h2>
          <span class="post-meta">  &bullet; </span>
        </div>
      </a>
    </div>
  </div> <!-- .templateux-section -->


</div> <!-- .templateux-section -->



<footer class="templateux-footer bg-light">
  <div class="container">

    <div class="row mb-5">
      <div class="col-md-4 pr-md-5">
        <div class="block-footer-widget">
          <h3>About</h3>
          <p>Specializing in client-centric software development and related consulting and business process outsourcing services we deploy state of the art technologies, robust development tools to deliver on our quality promise.</p>
        </div>
      </div>

      <div class="col-md-8">
        <div class="row">
          <div class="col-md-3">
            <div class="block-footer-widget">
              <h3>Learn More</h3>
              <ul class="list-unstyled">
                <li><a href="#">How it works?</a></li>
                <li><a href="#">Useful Tools</a></li>
                <li><a href="#">Pricing</a></li>
                <li><a href="#">Sitemap</a></li>
              </ul>
            </div>
          </div>
          <div class="col-md-3">
            <div class="block-footer-widget">
              <h3>Support</h3>
              <ul class="list-unstyled">
                <li><a href="#">FAQ</a></li>
                <li><a href="#">Contact Us</a></li>
                <li><a href="mailto:support@hrdik.com">Help Desk</a></li>
                <li><a href="#">Knowledgebase</a></li>
              </ul>
            </div>
          </div>
          <div class="col-md-3">
            <div class="block-footer-widget">
              <h3>About Us</h3>
              <ul class="list-unstyled">
                <li><a href="#">About Us</a></li>
                <li><a href="#">Careers</a></li>
                <li><a href="#">Terms of Service</a></li>
                <li><a href="#">Privacy Policy</a></li>
              </ul>
            </div>
          </div>

          <div class="col-md-3">
            <div class="block-footer-widget">
              <h3>Connect With Us</h3>
              <ul class="list-unstyled block-social">
                <li><a href="#" class="p-1"><span class="icon-facebook-square"></span></a></li>
                <li><a href="#" class="p-1"><span class="icon-twitter"></span></a></li>
                <li><a href="#" class="p-1"><span class="icon-github"></span></a></li>
              </ul>
            </div>
          </div>
        </div> <!-- .row -->

      </div>
    </div> <!-- .row -->

    <div class="row pt-5 text-center">
      <div class="col-md-12 text-center"><p>
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