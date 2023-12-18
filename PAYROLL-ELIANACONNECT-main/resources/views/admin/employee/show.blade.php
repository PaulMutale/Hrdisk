@extends('admin.layout.app')

@section('title') Employees @endsection

@section('css')
<style type="text/css">
    .overflow-visible{
        overflow: visible !important;
    }
    td.p-0 img.img-thumbnail{
      width: 140px;
    }
    button.h-33{
      height: 33px !important;
    }
    #map{
      height: 500px;
      border: 2px solid #00000054;
      border-radius: 11px;
    }
</style>
@endsection

@section('content')
       @php 
                
               $employee_kyc = \App\employee_kyc::where('employee_email',"=",$employee->email)->latest()->first();  
               $medicals = $employee_kyc->employee_medicals;
               $passport_photo = $employee_kyc->employee_passport_photo;
               $signature_photo = $employee_kyc->borrower_photo_signature;
                
                
                @endphp

        <div class="card">

          <div class="tab-content">
            <div class="tab-pane fade show active" id="overview">
               @if($medicals =='NULL')
                     Employee Didn't Upload Medical Forms
                      @else
                      <a href='{{asset("LOGOS_UPLOADS/$medicals")}}'> Download Medical Form </a>
                      @endif     
                     <br> 
              <div class="list-group">
                <a class="list-group-item list-group-item-action flex-column align-items-start">
                  <div class="row">
                    <div class="col-md-3 text-center">
                      @if(is_null($passport_photo))
                      <img src="{{ $employee->media_url['thumb'] }}" class="rounded-circle show-avatar" alt="{{ $employee->employee_id }}'s Avatar">
                      @else
                  <img src='{{ asset("LOGOS_UPLOADS/$passport_photo")}}' class="rounded-circle show-avatar" alt="{{ $employee->employee_id }}'s Avatar">    
                      
                      @endif
                      
                  
                      
                      
                    </div>
                    
                    
                    
                    
                    <div class="col-md-6 col-lg-6 my-auto">
                      <h5 class="mb-0">{{ $employee->first_name.' '.$employee->last_name }}</h5>
                      <p class="mb-2" title="employee_id"><small><i class="ik ik-at-sign"></i>{{ $employee->employee_id }}</small></p>
                    </div>
                    <div class="col-md-4 col-lg-4">
                      <small class="text-muted float-right">{{ $employee->created }}</small>
                    </div>
                  </div>
                </a>
                <a class="list-group-item list-group-item-action flex-column align-items-start">
                  <div class="row">
                    <div class="col-md-3 text-right">
                      <b>Employee-Id : </b>
                    </div>
                    <div class="col-md-9">
                      <span>{{ $employee->employee_id }}</span>
                    </div>
                  </div>
                </a>
                <a class="list-group-item list-group-item-action flex-column align-items-start">
                  <div class="row">
                    <div class="col-md-3 text-right">
                      <b>Employee-TPIN : </b>
                    </div>
                    <div class="col-md-9">
                      <span>{{ $employee->tpin }}</span>
                    </div>
                  </div>
                </a>
                <a class="list-group-item list-group-item-action flex-column align-items-start">
                  <div class="row">
                    <div class="col-md-3 text-right">
                      <b>Email : </b>
                    </div>
                    <div class="col-md-9">
                      <span>{{ $employee->email }}</span>
                    </div>
                  </div>
                </a>
                <a class="list-group-item list-group-item-action flex-column align-items-start">
                  <div class="row">
                    <div class="col-md-3 text-right">
                      <b>Phone : </b>
                    </div>
                    <div class="col-md-9">
                      <span>{{ $employee->phone }}</span>
                    </div>
                  </div>
                </a>
                <a class="list-group-item list-group-item-action flex-column align-items-start">
                  <div class="row">
                    <div class="col-md-3 text-right">
                      <b>Birthdate : </b>
                    </div>
                    <div class="col-md-9">
                      <span>{{ $employee->birthdate }}</span>
                    </div>
                  </div>
                </a>
                <a class="list-group-item list-group-item-action flex-column align-items-start">
                  <div class="row">
                    <div class="col-md-3 text-right">
                      <b>Gender : </b>
                    </div>
                    <div class="col-md-9">
                      <span>{{ $employee->gender }}</span>
                    </div>
                  </div>
                </a>
                
                 <a class="list-group-item list-group-item-action flex-column align-items-start">
                  <div class="row">
                    <div class="col-md-3 text-right my-auto">
                      <b>Next of Kin : </b>
                    </div>
                    <div class="col-md-9">
                     
                     {{ $employee_kyc->nok }}
                     


                    </div>
                  </div>
                </a> 
                
                <a class="list-group-item list-group-item-action flex-column align-items-start">
                  <div class="row">
                    <div class="col-md-3 text-right my-auto">
                      <b>Name of NOK : </b>
                    </div>
                    <div class="col-md-9">
                     
                     {{ $employee_kyc->name_of_nok }}
                     


                    </div>
                  </div>
                </a> 
                
                <a class="list-group-item list-group-item-action flex-column align-items-start">
                  <div class="row">
                    <div class="col-md-3 text-right my-auto">
                      <b>Phone of NOK : </b>
                    </div>
                    <div class="col-md-9">
                     
                     {{ $employee_kyc->phone_of_nok }}
                     


                    </div>
                  </div>
                </a> 
                
                
                
                <a class="list-group-item list-group-item-action flex-column align-items-start">
                  <div class="row">
                    <div class="col-md-3 text-right">
                      <b>Position : </b>
                    </div>
                    <div class="col-md-9">
                      <span>{{ $employee->position->title }}</span>
                    </div>
                  </div>
                </a>
                
                
                
                 <a class="list-group-item list-group-item-action flex-column align-items-start">
                  <div class="row">
                    <div class="col-md-3 text-right">
                      <b>Branch : </b>
                    </div>
                    <div class="col-md-9">
                      @if($employee->branch_name == 0)        
                      
                      <span>{{Auth::user()->username}}</span>
                      @else
                   <span>{{\App\Branches::find($employee->branch_name)->branch_name}}</span>   
                      @endif
                    </div>
                  </div>
                </a>
                
               <a class="list-group-item list-group-item-action flex-column align-items-start">
                  <div class="row">
                    <div class="col-md-3 text-right">
                      <b>Salary : </b>
                    </div>
                    <div class="col-md-9">
                      <span>ZMW {{ $employee->salary }}</span>
                    </div>
                  </div>
                </a> 
                
                 <a class="list-group-item list-group-item-action flex-column align-items-start">
                  <div class="row">
                    <div class="col-md-3 text-right">
                      <b>Rate Per Hour : </b>
                    </div>
                    <div class="col-md-9">
                      <span>ZMW {{ $employee->rate_per_hour }}</span>
                    </div>
                  </div>
                </a>               
                
                <a class="list-group-item list-group-item-action flex-column align-items-start">
                  <div class="row">
                    <div class="col-md-3 text-right">
                      <b>Remark : </b>
                    </div>
                    <div class="col-md-9">
                      <span>{{ $employee->remark }}</span>
                    </div>
                  </div>
                </a>
                <a class="list-group-item list-group-item-action flex-column align-items-start">
                  <div class="row">
                    <div class="col-md-3 text-right">
                      <b>Schedule : </b>
                    </div>
                    <div class="col-md-9">
                      <span>{{ $employee->schedule->time_in.'-'.$employee->schedule->time_out }}</span>
                    </div>
                  </div>
                </a>
                <a class="list-group-item list-group-item-action flex-column align-items-start">
                  <div class="row">
                    <div class="col-md-3 text-right my-auto">
                      <b>Address : </b>
                    </div>
                    <div class="col-md-9">
                      @if(!is_null($employee->address))
                      <i class='ik ik-map-pin'></i> {{ $employee->address }}
                      @endif


                    </div>
                  </div>
                </a>
                
               <a class="list-group-item list-group-item-action flex-column align-items-start">
                  <div class="row">
                    <div class="col-md-3 text-right my-auto">
                      <b>Bank Name : </b>
                    </div>
                    <div class="col-md-9">
                     
                      {{ $employee_kyc->employee_bank_name }}
                     


                    </div>
                  </div>
                </a> 
                
                
                
                
                 <a class="list-group-item list-group-item-action flex-column align-items-start">
                  <div class="row">
                    <div class="col-md-3 text-right my-auto">
                      <b>Bank Branch : </b>
                    </div>
                    <div class="col-md-9">
                     
                       {{ $employee_kyc->employee_bank_branch }}
                     


                    </div>
                  </div>
                </a>               
                
                
                
                 <a class="list-group-item list-group-item-action flex-column align-items-start">
                  <div class="row">
                    <div class="col-md-3 text-right my-auto">
                      <b>Bank Account Number : </b>
                    </div>
                    <div class="col-md-9">
                     
                     {{ $employee_kyc->employee_bank_account_number }}
                     


                    </div>
                  </div>
                </a> 
                
                
                
                <a class="list-group-item list-group-item-action flex-column align-items-start">
                  <div class="row">
                    <div class="col-md-3 text-right my-auto">
                      <b>Publish : </b>
                    </div>
                    <div class="col-md-9">
                      @if($employee->is_active)
                      <span class="badge badge-pill badge-sm badge-success">Published</span>
                      @else
                      <span class="badge badge-pill badge-sm badge-danger">Not yet</span>
                      @endif
                    </div>
                  </div>
                </a>
                <a class="list-group-item list-group-item-action flex-column align-items-start">
                  <div class="row">
                    <div class="col-md-3 text-right my-auto">
                      <b>CreatedAt : </b>
                    </div>
                    <div class="col-md-9">
                      {{ $employee->created_on }}
                    </div>
                  </div>
                </a>
                
                 <a class="list-group-item list-group-item-action flex-column align-items-start">
                  <div class="row">
                    <div class="col-md-3 text-right my-auto">
                      <b>Joined At : </b>
                    </div>
                    <div class="col-md-9">
                      {{ date('M d, Y', strtotime($employee->employee_start_date))  }}
                    </div>
                  </div>
                </a>
                
              <a class="list-group-item list-group-item-action flex-column align-items-start">
                  <div class="row">
                    <div class="col-md-3 text-right my-auto">
                      <b>End Date : </b>
                    </div>
                    <div class="col-md-9">
                      {{ date('M d, Y', strtotime($employee->employee_end_date))  }}
                    </div>
                  </div>
                </a>   
                
                
                
                
                
                
                 
                
                
                
                
                
                
                

              </div>
            </div>
          </div>
        </div>

        @endsection
