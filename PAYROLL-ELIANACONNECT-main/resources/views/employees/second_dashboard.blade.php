@include('employees/menu_header') 
        
               
        
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                  <i class="mdi mdi-home"></i>
                </span> Dashboard
              </h3>
              <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                  <li class="breadcrumb-item active" aria-current="page">
                    <span></span>Overview <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                  </li>
                </ul>
              </nav>
            </div>
            <!--first Column-->
            <div class="row">
              <div class="col-md-3 stretch-card grid-margin">
                <div class="card bg-gradient-danger card-img-holder text-white">
                  <div class="card-body">
                    <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">KYC <i class="fa fa-user mdi-24px float-right"></i>
                    </h4>
                    <h4 class="mb-5">Finish KYC</h4>
                    <h6 class="card-text"><a style="color: white;" href="{{route('employees.kyc_personal_details_view')}}">Finish</a></h6>
                  </div>
                </div>
              </div>
              <div class="col-md-3 stretch-card grid-margin">
                <div class="card bg-gradient-info card-img-holder text-white">
                  <div class="card-body">
                    <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">Payroll <i class="fas fa-money-check-alt mdi-24px float-right"></i>
                    </h4>
                    <h4 class="mb-5">Add me on Payroll</h4>
                    <h6 class="card-text">Apply</h6>
                  </div>
                </div>
              </div>
              
              <div class="col-md-3 stretch-card grid-margin">
                <div class="card bg-gradient-success card-img-holder text-white">
                  <div class="card-body">
                    <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">CashAdvance <i class="fas fa-money-bill-wave-alt mdi-24px float-right"></i>
                    </h4>
                    <h4 class="mb-5">Apply for CashAdvance</h4>
                    <h6 class="card-text"><a style="color: white;" href="{{route('employees.kyc_cashadvance_details_view')}}">Apply</a></h6>
                  </div>
                </div>
              </div>


              <div class="col-md-3 stretch-card grid-margin">
                <div class="card bg-gradient-success card-img-holder text-white">
                  <div class="card-body">
                    <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">NAPSA <i class="fas fa-money-bill-wave-alt mdi-24px float-right"></i>
                    </h4>
                    <h4 class="mb-5">NAPSA Contributions</h4>
                    <h6 class="card-text"><a style="color: white;" href="{{route('employees.kyc_cashadvance_details_view')}}">Check</a></h6>
                  </div>
                </div>
              </div>

            </div>
<!--End first Column-->
            <!--Second Column-->

            <div class="row">
              <div class="col-md-3 stretch-card grid-margin">
                <div class="card bg-gradient-danger card-img-holder text-white">
                  <div class="card-body">
                    <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">Download Payslips <i class="fa fa-download mdi-24px float-right"></i>
                    </h4>
                    <h4 class="mb-5">Payslips</h4>
                    <h6 class="card-text">Select Month </h6>
                  </div>
                </div>
              </div>
              <div class="col-md-3 stretch-card grid-margin">
                <div class="card bg-gradient-info card-img-holder text-white">
                  <div class="card-body">
                    <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">Email Payslips <i class="fa fa-share-alt mdi-24px float-right"></i>
                    </h4>
                    <h4 class="mb-5">Share to my Email</h4>
                    <h6 class="card-text">Share</h6>
                  </div>
                </div>
              </div>
              <div class="col-md-3 stretch-card grid-margin">
                <div class="card bg-gradient-success card-img-holder text-white">
                  <div class="card-body">
                    <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">Leave Days Balance <i class="fas fa-calendar-alt mdi-24px float-right"></i>
                    </h4>
                    <h4 class="mb-5">Leave Days</h4>
                    <a style="color: white;" href="{{route('employees.leave_details_view')}}">Apply</a>
                  </div>
                </div>
              </div>


              <div class="col-md-3 stretch-card grid-margin">
                <div class="card bg-gradient-success card-img-holder text-white">
                  <div class="card-body">
                    <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">History <i class="fas fa-money-bill-wave-alt mdi-24px float-right"></i>
                    </h4>
                    <h4 class="mb-5">Leave History </h4>
                    <h6 class="card-text"><a style="color: white;" href="{{route('employees.kyc_cashadvance_details_view')}}">Check</a></h6>
                  </div>
                </div>
              </div>

            </div>
            <!--End second Column-->




           





            
                           

         


      @include('employees/footer')