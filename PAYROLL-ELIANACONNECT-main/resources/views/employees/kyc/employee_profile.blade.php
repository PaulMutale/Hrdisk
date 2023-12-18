
@include('employees/menu_header') 


<section style="background-color: #eee;">
  <div class="container py-5">
    <div class="row">
      <div class="col">
        <nav aria-label="breadcrumb" class="bg-light rounded-3 p-3 mb-4">
          <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{('employees_dashboard')}}">Home</a></li>
            <li class="breadcrumb-item"><a >User</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{Auth::guard('Employees')->user()->first_name}}'s' Profile</li>
          </ol>
        </nav>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-4">
        <div class="card mb-4">
          <div class="card-body text-center">
          @if(!empty($employee_passport_photo->employee_passport_photo))
          <img src="{{asset('LOGOS_UPLOADS/'.$employee_passport_photo->employee_passport_photo)}}" class="img-fluid my-5" width="100" height="100" alt="Company Logo"/> 
@else

            @if(Auth::guard('Employees')->user()->gender == 'Male' )
            <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava6.webp" alt="avatar"
              class="rounded-circle img-fluid" style="width: 150px;">
              @else
              <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava5.webp" alt="avatar"
              class="rounded-circle img-fluid" style="width: 150px;">
              @endif

              @endif
            <h5 class="my-3">{{Auth::guard('Employees')->user()->first_name}} {{Auth::guard('Employees')->user()->last_name}}</h5>
            <p class="text-muted mb-1">{{\App\Position::find(Auth::guard('Employees')->user()->position_id)->title}}</p>
            <p class="text-muted mb-4">{{Auth::guard('Employees')->user()->address}} </p>
            <div class="d-flex justify-content-center mb-2">
              <button type="button" class="btn btn-primary">Follow</button>
              <button type="button" class="btn btn-outline-primary ms-1">Message</button>
            </div>
          </div>
        </div>
        <div class="card mb-4 mb-lg-0">
          <div class="card-body p-0">
            <ul class="list-group list-group-flush rounded-3">
              <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                <i class="fas fa-globe fa-lg text-warning"></i>
                <p class="mb-0">Personal site </p>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                <i class="fab fa-github fa-lg" style="color: #333333;"></i>
                <p class="mb-0">GitHub Account</p>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                <i class="fab fa-twitter fa-lg" style="color: #55acee;"></i>
                <p class="mb-0">Twitter account</p>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                <i class="fab fa-instagram fa-lg" style="color: #ac2bac;"></i>
                <p class="mb-0">Instargram</p>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                <i class="fab fa-facebook-f fa-lg" style="color: #3b5998;"></i>
                <p class="mb-0">Facebook </p>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <div class="col-lg-8">
        <div class="card mb-4">
          <div class="card-body">
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Full Name</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">{{Auth::guard('Employees')->user()->first_name}} {{Auth::guard('Employees')->user()->last_name}} </p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Email</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">{{Auth::guard('Employees')->user()->email}} </p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Phone</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">{{Auth::guard('Employees')->user()->phone}} </p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Mobile</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">{{Auth::guard('Employees')->user()->phone}} </p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Address</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">{{Auth::guard('Employees')->user()->address}} </p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Birthdate</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">{{Auth::guard('Employees')->user()->birthdate}} </p>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="card mb-4 mb-md-0">
              <div class="card-body">
                <p class="mb-4"><span class="text-primary font-italic me-1">assigment</span> Project Status
                </p>
                <p class="mb-1" style="font-size: .77rem;">{{\App\Position::find(Auth::guard('Employees')->user()->position_id)->title}}</p>
                <div class="progress rounded" style="height: 5px;">
                  <div class="progress-bar" role="progressbar" style="width: 80%" aria-valuenow="80"
                    aria-valuemin="0" aria-valuemax="100"></div>
                </div>
               
              </div>
            </div>
          </div>

          <div class="col-md-6">
            <div class="card mb-4 mb-md-0">
              <div class="card-body">
                <p class="mb-4"><span class="text-primary font-italic me-1">Work Profile</span> Status
                </p>
                <p class="mb-1" style="font-size: .77rem;">Salary: ZMW {{Auth::guard('Employees')->user()->salary}}</p>
                
                <p class="mt-4 mb-1" style="font-size: .77rem;">Rate per hour: {{Auth::guard('Employees')->user()->rate_per_hour}} </p>
              
                <p class="mt-4 mb-1" style="font-size: .77rem;">Employed On : {{ date('M d, Y', strtotime(Auth::guard('Employees')->user()->employee_start_date))}}</p>
               
              </div>
            </div>
          </div>


          
        </div>
      </div>
    </div>
  </div>
</section>


@include('employees/footer')