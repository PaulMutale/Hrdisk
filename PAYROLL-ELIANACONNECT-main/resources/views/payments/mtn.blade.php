@include('payments.payments_header')
<div class="shadow p-3 mb-5 bg-white rounded">
<form action="javascript:void(0)" method="POST" id="createEmployee">

                    @csrf
                    <div class="img-box">
                            <img src="{{asset('payments/mtn.webp')}}" alt="Airtel Payments">
                        </div>
                    <div class="row">
                      <div class="col-md-12 col-lg-12 col-sm-12">
                       <div class="form-group">
                        <label for="first_name">Amount (ZMW)</label><small class="text-danger">*</small>
                        <input type="number" name="amount" class="form-control" id="first_name">
                        <small class="text-danger err" id="first_name-err"></small>
                      </div>
                      </div>
                      <div class="col-md-12 col-lg-12 col-sm-12">
                       <div class="form-group">
                        <label for="last_name">Phone Number </label><small class="text-danger">*</small>
                        <input type="number" name="last_name" class="form-control" id="last_name" >
                        <small class="text-danger err" id="last_name-err"></small>
                      </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12 col-lg-12 col-sm-12">
                        <div class="form-group">
                          <label for="number">Company ID</label><small class="text-danger">*</small>
                          <input type="number" name="email" class="form-control" id="email" >
                          <input type="hidden" name="username">
                          <small class="text-danger err" id="email-err"></small>
                        </div>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-success">MAKE PAYMENT</button>
</form>
</div>

@include('payments.payments_footer')