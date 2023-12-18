<!doctype html>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title> E-Systems - A System for Human Resource Management.</title>
        <meta name="description" content="">
        <meta name="keywords" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="icon" />
        <!-- Favicons -->
  <link href="{{asset('landing_assets/img/fav.PNG')}}" rel="icon">
  <link href="{{asset('landing_assets/img/apple-touch-icon.PNG')}}" rel="apple-touch-icon">
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" integrity="sha512-aOG0c6nPNzGk+5zjwyJaoRUgCdOrfSDhmMID2u4+OIslr0GjpLKo7Xm0Ao3xmpM4T8AmIouRkqwj1nrdVsLKEQ==" crossorigin="anonymous" />     
        <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,400,600,700,800" rel="stylesheet">
        <!--Fontawesome--> 

<!-- Add the tippy.js CSS file -->
<link rel="stylesheet" href="https://unpkg.com/@popperjs/core@2.10.3/lib/styles.css" />

<!-- Add the tippy.js JavaScript file -->
<script src="https://unpkg.com/@popperjs/core@2.10.3/lib/popper.js"></script>
<script src="https://unpkg.com/tippy.js@6.3.1/dist/tippy-bundle.umd.min.js"></script>



<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
       
      
     
      
      <link rel="stylesheet" href="{{ asset('admin_assets/plugins/bootstrap/dist/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('admin_assets/plugins/fontawesome-free/css/all.min.css') }}">
        <link rel="stylesheet" href="{{ asset('admin_assets/plugins/icon-kit/dist/css/iconkit.min.css') }}">
        <link rel="stylesheet" href="{{ asset('admin_assets/plugins/ionicons/dist/css/ionicons.min.css') }}">
        <link rel="stylesheet" href="{{ asset('admin_assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}">
        <link rel="stylesheet" href="{{ asset('admin_assets/plugins/select2/dist/css/select2.min.css') }}">
        <link rel="stylesheet" href="{{ asset('admin_assets/plugins/jquery-toast-plugin/dist/jquery.toast.min.css') }}">
        <link rel="stylesheet" href="{{ asset('admin_assets/plugins/summernote/dist/summernote-bs4.css') }}">
        <link rel="stylesheet" href="{{ asset('admin_assets/plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
        <link rel="stylesheet" href="{{ asset('admin_assets/plugins/tempusdominus-bootstrap-4/build/css/tempusdominus-bootstrap-4.min.css') }}">
        <link rel="stylesheet" href="{{ asset('admin_assets/plugins/jquery-minicolors/jquery.minicolors.css') }}">
        <link rel="stylesheet" href="{{ asset('admin_assets/plugins/weather-icons/css/weather-icons.min.css') }}">
        <link rel="stylesheet" href="{{ asset('admin_assets/plugins/c3/c3.min.css') }}">
        <link rel="stylesheet" href="{{ asset('admin_assets/plugins/owl.carousel/dist/assets/owl.carousel.min.css') }}">
        <link rel="stylesheet" href="{{ asset('admin_assets/plugins/mohithg-switchery/dist/switchery.min.css') }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css">
        <link rel="stylesheet" href="{{ asset('admin_assets/plugins/sweetalert/dist/bootstrap-4.min.css') }}">
        <link rel="stylesheet" href="{{ asset('admin_assets/plugins/owl.carousel/dist/assets/owl.theme.default.min.css') }}">
        <link rel="stylesheet" href="{{ asset('admin_assets/plugins/json-viewer/jquery.json-viewer.css') }}">
        <link rel="stylesheet" href="{{ asset('admin_assets/dist/css/theme.min.css') }}">
        <script src="{{ asset('admin_assets/src/js/vendor/modernizr-2.8.3.min.js') }}"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.2/croppie.min.css"/>
        <link rel="stylesheet" type="text/css" href="{{ asset('admin_assets/dist/css/site-style.css') }}">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        
<!--Datatables Buttons-->    
    <link href='https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css' rel='stylesheet' type='text/css'>

    <!--End Datatables Buttons-->
        @yield('css')

    </head>

    <body>
    <style>
     
       </style> 
       @include('sweetalert::alert')
        <div class="wrapper">
            <header class="header-top" header-theme="light">
                <div class="container-fluid">
                    <div class="d-flex justify-content-between">
                        <div class="top-menu d-flex align-items-center">
                            
                            <button type="button" id="navbar-fullscreen" class="nav-link"><i class="ik ik-maximize"></i></button>
                           
                        </div>
                        <div class="top-menu d-flex align-items-center">
                            
                            <button type="button" class="mobile-nav-toggle"><i class="fa fa-bars" aria-hidden="true"></i> Menu</button>
                        </div>
                        <div class="top-menu d-flex align-items-center">
                            <div class="">
                                <span class="text-secondary mr-2">{{ Auth::user()->username }}</span>
                            </div>
                            <div class="dropdown">
                            
                               @if(!empty(Auth::user()->principle_passport_photo))
                            <a class="dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img class="avatar" src="{{asset('LOGOS_UPLOADS/'.Auth::user()->principle_passport_photo)}}" alt="Principal Passport Photo"></a>

@else

                                <a class="dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img class="avatar" src="{{ asset('admin_assets/avatars/admin/admin.png') }}" alt="Principal Passport Photo"></a>
                              
           @endif      
                               
                               
                               
                               <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                                    <a class="dropdown-item" href="{{ route('admin.profile.index') }}"><i class="ik ik-user dropdown-icon"></i> Profile</a>
                                    
                                    <a class="dropdown-item" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="ik ik-power dropdown-icon"></i> Logout</a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </header>

            <div class="page-wrap">
                <div class="app-sidebar colored">
                    <div class="sidebar-header">
                        <a class="header-brand" href="{{ url('/') }}">
                          <center>
                            <div class="logo-img">
                                <h4 style="font-weight:bold">E-<span style="font-style: italic;color:red">SYSTEMS</span></h4>
                           
                            </div>
                            
                          </center>
                        </a>
                        <button type="button" class="nav-toggle"><i data-toggle="expanded" class="ik ik-toggle-right toggle-icon"></i></button>
                        <button id="sidebarClose" class="nav-close"><i class="ik ik-x"></i></button>
                    </div>
                    
                    <div class="sidebar-content">
                        @include('admin.layout.menu')
                    </div>
                </div>
                <div class="main-content">
                    <div class="container-fluid">
                       
                        @yield('content')
                        
                    </div>
                </div>

                

                <footer class="footer">
                    <div class="w-100 clearfix">
                        <span class="text-center text-sm-left d-md-inline-block">copyright@ {{date('Y')}} - ElianaConnect.</span>
                        
                    </div>
                </footer>
                
            </div>
        </div>
        
          
       <!--Countdown timer-->       

       <script>

var countDownDate = new Date("{{Auth::user()->payments_made_at}}").getTime();

// Update the count down every 1 second
var x = setInterval(function() {

  // Get today's date and time
  var now = new Date().getTime();

  // Find the distance between now and the count down date
  var distance = countDownDate - now;

  // Time calculations for days, hours, minutes and seconds
  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);

  // Display the result in the element with id="demo"
  document.getElementById("demo").innerHTML ="PAYMENTS DUE: "+ days + "d " + hours + "h "
  + minutes + "m " + seconds + "s ";

  // If the count down is finished, write some text
  if (distance < 0) {
    clearInterval(x);
    document.getElementById("demo").innerHTML = "SUBSCRIPTION EXPIRED";
    window.location.href = "{{route('admin.subscriptionExpired')}}";
  }
}, 1000);
</script>


       <!--End countdown timer-->
        
        
        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
        {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> --}}
        <script>window.jQuery || document.write('<script src="src/js/vendor/jquery-3.3.1.min.js"><\/script>')</script>
        <script src="{{ asset('admin_assets/plugins/popper.js/dist/umd/popper.min.js') }}"></script>
        <script src="{{ asset('admin_assets/plugins/bootstrap/dist/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('admin_assets/plugins/perfect-scrollbar/dist/perfect-scrollbar.min.js') }}"></script>
        <script src="{{ asset('admin_assets/plugins/select2/dist/js/select2.min.js') }}" ></script>
        <script src="{{ asset('admin_assets/plugins/summernote/dist/summernote-bs4.min.js') }}"></script>
        <script src="{{ asset('admin_assets/plugins/ckeditor5/build/ckeditor.js') }}"></script>
        <script src="{{ asset('admin_assets/plugins/screenfull/dist/screenfull.js') }}"></script>
        <script src="{{ asset('admin_assets/plugins/datatables.net/js/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('admin_assets/plugins/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('admin_assets/plugins/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
        <script src="{{ asset('admin_assets/plugins/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('admin_assets/plugins/moment/moment.js') }}"></script>
        <script src="{{ asset('admin_assets/plugins/tempusdominus-bootstrap-4/build/js/tempusdominus-bootstrap-4.min.js') }}"></script>
        <script src="{{ asset('admin_assets/plugins/jquery-minicolors/jquery.minicolors.min.js') }}"></script>
        <script src="{{ asset('admin_assets/plugins/d3/dist/d3.min.js') }}"></script>
        <script src="{{ asset('admin_assets/plugins/c3/c3.min.js') }}"></script>
        <script src="{{ asset('admin_assets/js/tables.js') }}"></script>
        <script src="{{ asset('admin_assets/js/widgets.js') }}"></script>
        <script src="{{ asset('admin_assets/js/charts.js') }}"></script>
        <script src="{{ asset('admin_assets/plugins/mohithg-switchery/dist/switchery.min.js') }}"></script>
        <script src="{{ asset('admin_assets/plugins/jquery-toast-plugin/dist/jquery.toast.min.js')}}"></script>
        <script src="{{ asset('admin_assets/plugins/JQuery-mask-plugin/jquery.mask.min.js')}}"></script>
        <script src="{{ asset('admin_assets/plugins/owl.carousel/dist/owl.carousel.min.js')}}"></script>
        <script src="{{ asset('admin_assets/plugins/json-viewer/jquery.json-viewer.js')}}"></script>
        <script src="{{ asset('admin_assets/plugins/jquery.repeater/jquery.form-repeater.min.js')}}"></script>
        {{-- <script src="http://malsup.github.com/jquery.form.js"></script> --}}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>

      <!--Datatables Buttons starts here-->    

     <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
     <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
     <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js" type="text/javascript"></script>

<!--Datatables Buttons ends here-->
      
      
      
      
      
        <script src="{{ asset('admin_assets/plugins/sweetalert/dist/sweetalert.min.js') }}"></script>
        <script src="{{ asset('admin_assets/dist/js/theme.min.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.2/croppie.js"></script>
        <script type="text/javascript" src="{{ asset('admin_assets/src/js/site-scripts.js') }}"></script>
        <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
        <script>
            (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
            function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
            e=o.createElement(i);r=o.getElementsByTagName(i)[0];
            e.src='https://www.google-analytics.com/analytics.js';
            r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
            ga('create','UA-XXXXX-X','auto');ga('send','pageview');
        </script>

        @yield('js')
    </body>
</html>
