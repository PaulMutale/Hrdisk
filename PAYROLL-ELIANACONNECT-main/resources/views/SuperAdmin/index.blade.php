<!DOCTYPE html>
<html lang="en">
  <head>
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
    
    
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-90680653-2"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-90680653-2');
    </script>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
   
 <!--datatables starts here-->   
     
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.css">
  
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.js"></script>
<!--datatables ends here-->     
    
    
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Twitter -->
    <!-- <meta name="twitter:site" content="@bootstrapdash">
    <meta name="twitter:creator" content="@bootstrapdash">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Azia">
    <meta name="twitter:description" content="Responsive Bootstrap 4 Dashboard Template">
    <meta name="twitter:image" content="https://www.bootstrapdash.com/azia/img/azia-social.png"> -->

    <!-- Facebook -->
    <!-- <meta property="og:url" content="https://www.bootstrapdash.com/azia">
    <meta property="og:title" content="Azia">
    <meta property="og:description" content="Responsive Bootstrap 4 Dashboard Template">

    <meta property="og:image" content="https://www.bootstrapdash.com/azia/img/azia-social.png">
    <meta property="og:image:secure_url" content="https://www.bootstrapdash.com/azia/img/azia-social.png">
    <meta property="og:image:type" content="image/png">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="600"> -->

    <!-- Meta -->
    <meta name="description" content="HRDISK - SUPERADMIN">
    <meta name="author" content="HRDISK - SUPERADMIN DASHBOARD">
    <meta name="csrf-token" content="{{ csrf_token() }}">
     <!-- Favicons -->
  <link href="{{asset('landing_assets/img/fav.PNG')}}" rel="icon">
  <link href="{{asset('landing_assets/img/apple-touch-icon.PNG')}}" rel="apple-touch-icon">
    <title>SUPERADMIN::HRDISK</title>

    <!-- vendor css -->
    <link href="{{asset('superadmin/lib/fontawesome-free/css/all.min.css')}}" rel="stylesheet">
    <link href="{{asset('superadmin/lib/ionicons/css/ionicons.min.css')}}" rel="stylesheet">
    <link href="{{asset('superadmin/lib/typicons.font/typicons.css')}}" rel="stylesheet">
    <link href="{{asset('superadmin/lib/flag-icon-css/css/flag-icon.min.css')}}" rel="stylesheet">

    <!-- azia CSS -->
    <link rel="stylesheet" href="{{asset('superadmin/css/azia.css')}}">
  </head>
  <body>
@include('sweetalert::alert')
    <div class="az-header">
      <div class="container">
        <div class="az-header-left">
          <a href="javascript:void()" class="az-logo"><span></span> HRDISK</a>
          <a href="" id="azMenuShow" class="az-header-menu-icon d-lg-none"><span></span></a>
        </div><!-- az-header-left -->
        <div class="az-header-menu">
          <div class="az-header-menu-header">
            <a href="javascript:void(0)" class="az-logo"><span></span> HRDISK</a>
            <a href="" class="close">&times;</a>
          </div><!-- az-header-menu-header -->
          <ul class="nav">
            <li class="nav-item active show">
              <a href="javascript:void(0)" class="nav-link"><i class="typcn typcn-chart-area-outline"></i> Dashboard</a>
            </li>
           
            <!--start date starts here-->

            <li class="nav-item">
             
              <form action="{{route('superadmin.dashboard')}}" method="post">
              @csrf
                <label for="startDate"> From </label>
                
                <select name="day1" id="day"></select>
                <select name="month1" id="month"></select>
                <select name="year1" id="year"></select>
               
                <label for="startDate"> To </label>
                              
                <select name="day2" id="day-end"></select>
                <select name="month2" id="month-end"></select>
                <select name="year2" id="year-end"></select>

               
                <button type="submit" class="btn btn success"><i class="fas fa-search"></i></button>
              </form>
             
            </li>


            <!--start date ends here-->



            
            
           
          </ul>
        </div><!-- az-header-menu -->
        <div class="az-header-right">
         
          
         


         
          <div class="dropdown az-profile-menu">
            <a href="" class="az-img-user"><img src="{{asset('superadmin/img/faces/face1.jpg')}}" alt=""></a>
            <div class="dropdown-menu">
              <div class="az-dropdown-header d-sm-none">
                <a href="" class="az-header-arrow"><i class="icon ion-md-arrow-back"></i></a>
              </div>
              <div class="az-header-profile">
                <div class="az-img-user">
                  <img src="{{asset('superadmin/img/faces/face1.jpg')}}" alt="">
                </div><!-- az-img-user -->
                <h6>SUPER-ADMIN</h6>
                <span>SUPERADMIN</span>
              </div><!-- az-header-profile -->
<!--
              <a href="javascript:void(0)" class="dropdown-item"><i class="typcn typcn-user-outline"></i> My Profile</a>
              
              <a href="" class="dropdown-item"><i class="typcn typcn-edit"></i> Edit Profile</a>
              <a href="" class="dropdown-item"><i class="typcn typcn-time"></i> Activity Logs</a>
              <a href="" class="dropdown-item"><i class="typcn typcn-cog-outline"></i> Account Settings</a>
              -->
                                                  
              <a onclick="event.preventDefault();document.getElementById('logout-form').submit();" style="cursor:pointer" class="dropdown-item"><i class="typcn typcn-power-outline"></i> Sign Out</a>
            </div><!-- dropdown-menu -->
          </div>
        </div><!-- az-header-right -->
      </div><!-- container -->
    </div><!-- az-header -->

    <div class="az-content az-content-dashboard">
      <div class="container">
        <div class="az-content-body">
          <div class="az-dashboard-one-title">
            <div>
              <h2 class="az-dashboard-title">Hi, welcome back!</h2>
              <p class="az-dashboard-text">Your web analytics dashboard template.</p>
            </div>
            <div class="az-content-header-right">
              <div class="media">
                <div class="media-body">
                  <label>Start Date</label>
                  <h6>{{date('d F-Y',strtotime($StartDate))}}</h6>
                </div><!-- media-body -->
              </div><!-- media -->
              <div class="media">
                <div class="media-body">
                  <label>End Date</label>
                  <h6>{{date('d F-Y',strtotime($EndDate))}}</h6>
                </div><!-- media-body -->
              </div><!-- media -->
              <div class="media">
                <div class="media-body">
                  <label>Event Category</label>
                  <h6>All Categories</h6>
                </div><!-- media-body -->
              </div><!-- media -->
              
            </div>
          </div><!-- az-dashboard-one-title -->

          <div class="row row-sm mg-b-20">
            <div class="col-lg-12 ht-lg-100p">
              <div class="card card-dashboard-one">
                <div class="card-header">
                  <div>
                    <h6 class="card-title">Website Audience Metrics</h6>
                    <p class="card-text">Web visitors analytics.</p>
                  </div>
                  <!--
                  <div class="btn-group">
                    <button class="btn active">Day</button>
                    <button class="btn">Week</button>
                    <button class="btn">Month</button>
                  </div>
                -->
                </div><!-- card-header -->
                <div class="card-body">
                  <div class="card-body-top">
                    <div>
                      <label class="mg-b-0">Companies</label>
                      <h2>{{$Companies->count()}}</h2>
                    </div>
                    <!--
                    <div>
                      <label class="mg-b-0">Bounce Rate</label>
                      <h2>33.50%</h2>
                    </div>
                  -->
                    <div>
                      <label class="mg-b-0">Page Views (Landing Page)</label>
                      <h2>{{$TrackUsers->count()}}</h2>
                    </div>
                    <div>
                      <label class="mg-b-0">Payments Recieved</label>
                      <h2>$0.00</h2>
                    </div>                  
                    
                    
                  
                  </div>
                  
                  
          <div class="row ">
    <div class="col-6 cursure-pointer">        
                  
                  
                    
{!! $chartPie->container() !!}
 
 <script src="{{ $chartPie->cdn() }}"></script>

 {{ $chartPie->script() }}
                    
                    
                    
                  
                
      
    </div>
       <div class="col-6 cursure-pointer">        
                  
                  
                    
{!! $chartAllowances->container() !!}
 
 <script src="{{ $chartAllowances->cdn() }}"></script>

 {{ $chartAllowances->script() }}
                    
                    
                    
                   
                
      
      
      
      
            </div>
            
            
                  
                </div><!-- card-body -->
              </div><!-- card -->
              
              
              
  <!-- Company Names -->   
  
            <div class="row row-sm mg-b-20 mg-lg-b-0">
           
            <div class="col-lg-12 col-xl-12 mg-t-20 mg-lg-t-0">
              <div class="card card-table-one">
                <h6 class="card-title">Registered Companies</h6>
                <p class="az-content-text mg-b-20">This is the list of registered companies.</p>
                <div class="table-responsive">
                  <table id="company">
                    <thead>
                      <tr>
                       
                        <th class="wd-45p">Company Name</th>
                        <th>Email</th>
                        <th>Email Verified at</th>
                        <th>Country Code</th>
                        <th>Address</th>
                        <th>Trial/Payments Due</th>
                        <th>Registered</th>
                        <th>Action</th>
                       
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($Companies as $company)
                      <tr>                        
                         
                         <td><strong>{{$company->username}}</strong></td>
                         <td><strong>{{$company->email}}</strong></td>
                         <td><strong>{{$company->hasVerifiedEmail() == 1 ? date('d F-Y'): 'Email Not Verified'}}</strong></td>
                         <td><strong>{{$company->company_country}}</strong></td> 
                         <td><strong>{{$company->company_address}}</strong></td>
                         <td><strong>{{date('d F-Y', strtotime($company->payments_made_at))}}</strong></td>  
                         <td><strong>{{date('d F-Y', strtotime($company->created_at))}}</strong></td> 
                        <td><a onclick="return confirm('Are you sure you want to delete this company? This process is irreversible')" href="{{route('superadmin.trash_company',encrypt($company->id))}}"><i class='ik ik-trash-2 text-danger'></i></a></td> 
                      </tr>
                      @endforeach
                      
                    </tbody>
                  </table>
                  
                </div><!-- table-responsive -->
              </div><!-- card -->
            </div><!-- col-lg -->

          </div><!-- row -->
        </div><!-- az-content-body -->
      </div>
    </div><!-- az-content -->
  
  
  
  
  
  <!--Company Names Ends here-->
              
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          
  <!-- Agents Approval Funds -->   
  
            <div class="row row-sm mg-b-20 mg-lg-b-0">
           
            <div class="col-lg-12 col-xl-12 mg-t-20 mg-lg-t-0">
              <div class="card card-table-one">
                <h6 class="card-title">Agents Pending Approval</h6>
                <p class="az-content-text mg-b-20">This is the list of invited companies by Agents.</p>
                <div class="table-responsive">
                  <table id="commisions">
                    <thead>
                      <tr>
                       
                        <th class="wd-45p">Company Name</th>
                        <th>Agent Name</th>
                        <th>Email Verified at</th>
                        <th>Commision</th>
                        <th>Registered</th>
                        <th>Action</th>
                       
                      </tr>
                    </thead>
                    <tbody>
                      @php 
                      
                      $pending_commisions = \App\Commisions::where('is_approved',"=",0)->get();
                      $approved_commisions = \App\Commisions::where('is_approved',"=",1)->get();
                      
                      @endphp
                      
                      
                      @foreach ($pending_commisions as $verify_commision)
                      <tr>                        
                         
                         <td><strong>{{\App\Admin::where('security_number',"=",$verify_commision->company_id)->first()->username}}</strong></td>
                         <td><strong>{{\App\Employee::where('employee_id',"=",$verify_commision->agent_id)->first()->first_name}} {{\App\Employee::where('employee_id',"=",$verify_commision->agent_id)->first()->last_name}}</strong></td>
                         <td><strong>{{App\Admin::where('security_number',"=",$verify_commision->company_id)->first()->hasVerifiedEmail() == 1 ? date('d F-Y'): 'Email Not Verified'}}</strong></td>
                         <td><strong>{{$verify_commision->commisions}}</strong></td> 
                         <td><strong>{{date('d F-Y', strtotime($verify_commision->created_at))}}</strong></td> 
                        <td>
                          <a onclick="return confirm('Are you sure you dont want to approve this payment? This process is irreversible')" href="{{route('superadmin.approve_commision',encrypt($verify_commision->id))}}"><i class='fa fa-check text-success'></i></a>
                          <a onclick="return confirm('Are you sure you want to approve this payment? This process is irreversible')" href="{{route('superadmin.trash_commision',encrypt($verify_commision->id))}}"><i class='ik ik-trash-2 text-danger'></i></a>
                        </td> 
                      </tr>
                      @endforeach
                      
                    </tbody>
                  </table>
                  
                </div><!-- table-responsive -->
              </div><!-- card -->
            </div><!-- col-lg -->

          </div><!-- row -->



          <div class="row row-sm mg-b-20 mg-lg-b-0">    
           

          <div class="row row-sm mg-b-20">
            <div class="col-lg-12">
              <div class="card card-dashboard-pageviews">
                <div class="card-header">
                  <h6 class="card-title">Messages</h6>
                  <p class="card-body">This report is based on 100% of contact us registration from other countries.</p>
                </div><!-- card-header -->
                <div class="card-body">
                <div class="table-responsive">
                  <table id="messages">
                    <thead>
                      <tr>
                       
                        <th class="wd-45p">Sender</th>
                        <th>Email</th>
                        <th>Message</th>
                        <th>Sent On</th>
                        <th>Action</th>
                                               
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($Messages as $message)
                      <tr>                        
                         
                         <td><strong>{{$message->name}}</strong></td>
                         <td><strong>{{$message->email}}</strong></td>
                         <td><strong>{{$message->message}}</strong></td>
                         <td><strong>{{date('d F-Y', strtotime($message->created_at))}}</strong></td>
                        <td><a onclick="return confirm('Are you sure you want to delete this Message? This process is irreversible')" href="{{route('superadmin.trash_message',encrypt($message->id))}}"><i class='ik ik-trash-2 text-danger'></i></a></td> 
                        </tr>
                      @endforeach
                      
                    </tbody>
                  </table>
                  
                </div><!-- table-responsive -->                   
                 
                </div><!-- card-body -->
              </div><!-- card -->

            </div><!-- col -->
          </div>
          </div>





<!--Stats-->

<br><br>


            <div class="col-lg-12">
              <div class="card card-dashboard-pageviews">
                <div class="card-header">
                  <h6 class="card-title">Statutory Complaints</h6>
                  <p class="card-text">This report is based on the wrong statutories reported by other companies.</p>
                </div><!-- card-header -->
                <div class="card-body">
                  
                <div class="table-responsive">
                  <table id="stats">
                    <thead>
                      <tr>
                       
                        <th class="wd-45p">Company</th>
                        <th>Email</th>
                        <th>Message</th>
                        <th>Sent On</th>
                                               
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($Stats_queries as $stats)
                      <tr>                        
                         
                         <td><strong>{{\App\Admin::where('security_number',"=",$stats->security_number)->first()->username}}</strong></td>
                         <td><strong>{{\App\Admin::where('security_number',"=",$stats->security_number)->first()->email}}</strong></td>
                         <td><strong>{{$stats->reasons}}</strong></td>
                         <td><strong>{{date('d F-Y', strtotime($stats->created_at))}}</strong></td> 
                        </tr>
                      @endforeach
                      
                    </tbody>
                  </table>
                  
                </div><!-- table-responsive -->                
                  
                  
                 
                </div><!-- card-body -->
              </div><!-- card -->

            </div><!-- col -->

<!--End Stats-->




<!--visitors -->  

<div class="row row-sm mg-b-20 mg-lg-b-0">
           
           <div class="col-lg-12 col-xl-12 mg-t-20 mg-lg-t-0">
             <div class="card card-table-one">
               <h6 class="card-title">What pages do your users visit</h6>
               <p class="az-content-text mg-b-20">This is the list of users who visits on the homepage of your website.</p>
               <div class="table-responsive">
                 <table id="countries">
                   <thead>
                     <tr>
                       <th class="wd-5p">Country Flag</th>
                       <th class="wd-45p">Country</th>
                       <th>Region</th>
                       <th>IP</th>
                        <th>Visited On</th>
                      
                     </tr>
                   </thead>
                   <tbody>
                     @foreach ($TrackUsers as $tracked_users)
                     <tr>                        
                        <td><x-dynamic-component component="flag-country-{{$tracked_users->countryCode}}"/></td>
                        <td><strong>{{$tracked_users->countryName}}</strong></td>
                        <td><strong>{{$tracked_users->regionName}}</strong></td>
                        <td><strong>{{$tracked_users->ip}}</strong></td>  
                        <td><strong>{{date('d F-Y', strtotime($tracked_users->created_at))}}</strong></td>  
                     </tr>
                     @endforeach
                     
                   </tbody>
                 </table>
                 
               </div><!-- table-responsive -->
             </div><!-- card -->
           </div><!-- col-lg -->

         </div><!-- row -->
       


<!-- end visitors-->





        </div><!-- az-content-body -->
      </div>
    </div><!-- az-content -->
  
  
  
  
  
  <!--Agents Approval Funds Ends here-->
  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>


    <div class="az-footer ht-40">
      <div class="container ht-100p pd-t-0-f">
        <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © elianaconnect.com {{date('Y')}}</span>
        <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"> Free <a href="https://www.elianaconnect.com" target="_blank">E-SYSTEMS</a> from Elianaconnect</span>
      </div><!-- container -->
    </div><!-- az-footer -->


<script>
$(document).ready( function () {
$.noConflict();
    $('#countries').DataTable(
    {
        dom: 'Bfrtip',
        buttons: [
             'pdf','csv', 'excel', 'copy','print'
        ]
    });
    
   $('#commisions').DataTable(
    {
        dom: 'Bfrtip',
        buttons: [
             'pdf','csv', 'excel', 'copy','print'
        ]
    });  
    
    
    $('#company').DataTable();
    $('#messages').DataTable();
    $('#stats').DataTable();
});
</script>  





    <script src="{{asset('superadmin/lib/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('superadmin/lib/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('superadmin/lib/ionicons/ionicons.js')}}"></script>
    <script src="{{asset('superadmin/lib/jquery.flot/jquery.flot.js')}}"></script>
    <script src="{{asset('superadmin/lib/jquery.flot/jquery.flot.resize.js')}}"></script>
    <script src="{{asset('superadmin/lib/chart.js/Chart.bundle.min.js')}}"></script>
    <script src="{{asset('superadmin/lib/peity/jquery.peity.min.js')}}"></script>

    <script src="{{asset('superadmin/js/azia.js')}}"></script>
    <script src="{{asset('superadmin/js/chart.flot.sampledata.js')}}"></script>
    <script src="{{asset('superadmin/js/dashboard.sampledata.js')}}"></script>
    <script src="{{asset('superadmin/js/jquery.cookie.js')}}" type="text/javascript"></script>






<!--Date Time Filter-->
<script>   

$(document).ready(function() {
  const monthNames = ["January", "February", "March", "April", "May", "June",
    "July", "August", "September", "October", "November", "December"
  ];
  let qntYears = 4;
  let selectYear = $("#year");
  let selectMonth = $("#month");
  let selectDay = $("#day");
  let currentYear = new Date().getFullYear();

  for (var y = 0; y < qntYears; y++) {
    let date = new Date(currentYear);
    let yearElem = document.createElement("option");
    yearElem.value = currentYear
    yearElem.textContent = currentYear;
    selectYear.append(yearElem);
    currentYear--;
  }

  for (var m = 0; m < 12; m++) {
    let month = monthNames[m];
    let monthElem = document.createElement("option");
    monthElem.value = m+1;
    monthElem.textContent = month;
    selectMonth.append(monthElem);
  }

  var d = new Date();
  var month = d.getMonth();
  var year = d.getFullYear();
  var day = d.getDate();

  selectYear.val(year);
  selectYear.on("change", AdjustDays);
  selectMonth.val(month);
  selectMonth.on("change", AdjustDays);

  AdjustDays();
  selectDay.val(day)

  function AdjustDays() {
    var year = selectYear.val();
    var month = parseInt(selectMonth.val()) + 1;
    selectDay.empty();

    //get the last day, so the number of days in that month
    var days = new Date(year, month, 0).getDate();

    //lets create the days of that month
    for (var d = 1; d <= 31; d++) {
      var dayElem = document.createElement("option");
      dayElem.value = d;
      dayElem.textContent = d;
      selectDay.append(dayElem);
    }
  }
});
</script>
<!--End Date Time Filter-->




<!--Date Time Filter-->
    <script>
     <!--Datatables Buttons starts here-->    

     <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
     <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
     <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js" type="text/javascript"></script>

<!--Datatables Buttons ends here-->
    </script>
<script>   

  $(document).ready(function() {
    const monthNames = ["January", "February", "March", "April", "May", "June",
      "July", "August", "September", "October", "November", "December"
    ];
    let qntYears = 4;
    let selectYear = $("#year-end");
    let selectMonth = $("#month-end");
    let selectDay = $("#day-end");
    let currentYear = new Date().getFullYear();
  
    for (var y = 0; y < qntYears; y++) {
      let date = new Date(currentYear);
      let yearElem = document.createElement("option");
      yearElem.value = currentYear
      yearElem.textContent = currentYear;
      selectYear.append(yearElem);
      currentYear--;
    }
  
    for (var m = 0; m < 12; m++) {
      let month = monthNames[m];
      let monthElem = document.createElement("option");
      monthElem.value = m+1;
      monthElem.textContent = month;
      selectMonth.append(monthElem);
    }
  
    var d = new Date();
    var month = d.getMonth();
    var year = d.getFullYear();
    var day = d.getDate();
  
    selectYear.val(year);
    selectYear.on("change", AdjustDays);
    selectMonth.val(month);
    selectMonth.on("change", AdjustDays);
  
    AdjustDays();
    selectDay.val(day)
  
    function AdjustDays() {
      var year = selectYear.val();
      var month = parseInt(selectMonth.val()) + 1;
      selectDay.empty();
  
      //get the last day, so the number of days in that month
      var days = new Date(year, month, 0).getDate();
  
      //lets create the days of that month
      for (var d = 1; d <= 31; d++) {
        var dayElem = document.createElement("option");
        dayElem.value = d;
        dayElem.textContent = d;
        selectDay.append(dayElem);
      }
    }
  });
  </script>
  <!--End Date Time Filter-->

  </body>
</html>
