<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Contact Us &mdash; </title>
  <link rel="stylesheet" href="{{asset('landing_page/css/style.css')}}">
</head>
<body>
@include('sweetalert::alert')
  <div class="js-animsition animsition" id="site-wrap" data-animsition-in-class="fade-in" data-animsition-out-class="fade-out">


    <header class="templateux-navbar" role="banner">

      <div class="container"  data-aos="fade-down">
        <div class="row">

          <div class="col-3 templateux-logo">
            <a href="javascript:void()" class="animsition-link">HumanResources</a>
          </div>
          <nav class="col-9 site-nav">
            <button class="d-block d-md-none hamburger hamburger--spin templateux-toggle templateux-toggle-light ml-auto templateux-toggle-menu" data-toggle="collapse" data-target="#mobile-menu" aria-controls="mobile-menu" aria-expanded="false" aria-label="Toggle navigation">
              <span class="hamburger-box">
                <span class="hamburger-inner"></span>
              </span>
            </button> <!-- .templateux-toggle -->

            <ul class="sf-menu templateux-menu d-none d-md-block">
              <li class="active">
                <a href="{{('/')}}" class="animsition-link">Home</a>
              </li>
              <li><a href="{{route('login')}}" class="animsition-link">Employer Login</a></li>
              <li>
                <a href="{{('login_view')}}" class="animsition-link">Employee Login </a>
                
              </li>
             
            </ul> <!-- .templateux-menu -->

          </nav> <!-- .site-nav -->
          

        </div> <!-- .row -->
      </div> <!-- .container -->
    </header> <!-- .templateux-navba -->
    
    <div class="templateux-cover" style="background-image: url({{asset('landing_page/images/slider-1.jpg')}})">
      <div class="container">
        <div class="row align-items-lg-center">

          <div class="col-lg-6 order-lg-1 text-center mx-auto">
            <h1 class="heading mb-3 text-white" data-aos="fade-up">Contact us</h1>
            <p class="lead mb-5 text-white" data-aos="fade-up"  data-aos-delay="100">Get In touch with us by sending us an email using the form provided below.</p>
            
          </div>
          
        </div>
      </div>
    </div> <!-- .templateux-cover -->



    <div class="templateux-section">
      <div class="container">
        <div class="row mb-5">
          <div class="col-md-7 pr-md-7 mb-5">
            <form action="{{route('contact_us')}}" method="post">
              @csrf
              <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" class="form-control" id="name">
              </div>
              <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control" id="email">
              </div>
              
              <div class="form-group">
                <label for="message">Message</label>
                <textarea name="message" id="message" cols="30" rows="10" class="form-control"></textarea>
              </div>
              <div class="form-group">
                <input type="submit" class="btn btn-primary py-3 px-5" value="Send Message">
              </div>
            </form>
          </div>
          <div class="col-md-5">
            <div class="media block-icon-1 d-block text-center">
              <div class="icon mb-3"><span class="ion-ios-location-outline"></span></div>
              <div class="media-body">
                <h3 class="h5 mb-4">Northmead, Lusaka, Zambia</h3>
              </div>
            </div> <!-- .block-icon-1 -->

            <div class="media block-icon-1 d-block text-center">
              <div class="icon mb-3"><span class="ion-ios-telephone-outline"></span></div>
              <div class="media-body">
                <h3 class="h5 mb-4">+26 0972 960398</h3>
              </div>
            </div> <!-- .block-icon-1 -->

            <div class="media block-icon-1 d-block text-center">
              <div class="icon mb-3"><span class="ion-ios-email-outline"></span></div>
              <div class="media-body">
                <h3 class="h5 mb-4">support@hrdisk.com</h3>
              </div>
            </div> <!-- .block-icon-1 -->

          </div>
        </div> <!-- .row -->

      </div>
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