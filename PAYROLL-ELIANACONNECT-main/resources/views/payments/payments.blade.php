@include('payments.payments_header')




        <div class="container">
            <div class="col-12 mt-4">
                <div class="card p-3">
                    <center>
                        <p class="mb-0 fw-bold h4">Choose Your Prefered Payment Method</p>
                    </center>
                    
                </div>
            </div>
            <br><br>
            <div class="row">
               


                <div class="col-lg-3 mb-lg-0 mb-3">
                    <a target="_blank" href="{{route('payments.airtel')}}">
                    <div class="card p-3">
                        <div class="img-box">
                            <img src="airtel.png"
                                alt="">
                        </div>
                        <div class="number">
                            <label class="fw-bold">097/077*********</label>
                        </div>
                        <div class="d-flex align-items-center justify-content-between">
                            <small><span class="fw-bold"></span><span></span></small>
                            <small><span class="fw-bold"></span><span>AIRTELZM</span></small>
                        </div>
                    </div>
                    </a>
                </div>
                
                                <div class="col-lg-3 mb-lg-0 mb-3">
                    <a target="_blank" href="{{route('payments.mtn')}}">

                        <div class="card p-3">
                            <div class="img-box">
                                <img src="mtn.webp"
                                    alt="">
                            </div>
                            <div class="number">
                                <label class="fw-bold">096/076*******</label>
                            </div>
                            <div class="d-flex align-items-center justify-content-between">
                                <small><span class="fw-bold"></span><span></span></small>
                                <small><span class="fw-bold"></span><span>MTNZM</span></small>
                            </div>
                        </div>
                    </a>
                   
                </div>

                <div class="col-lg-3 mb-lg-0 mb-3">
                    <a target="_blank" href="{{route('payments.zamtel')}}">
                    <div class="card p-3">
                        <div class="img-box">
                            <img src="zamtelm.jpeg"
                                alt="">
                        </div>
                        <div class="number">
                            <label class="fw-bold">095/075*****</label>
                        </div>
                        <div class="d-flex align-items-center justify-content-between">
                            <small><span class="fw-bold"></span><span></span></small>
                            <small><span class="fw-bold"></span><span>ZAMTEL</span></small>
                        </div>
                    </div>
                    </a>
                </div>



 <div class="col-lg-3 mb-lg-0 mb-3">
                    <a target="_blank" href="{{route('payments.visa')}}">
                    <div class="card p-3">
                        <div class="img-box">
                            <img src="https://www.freepnglogos.com/uploads/visa-logo-download-png-21.png" alt="VISA">
                        </div>
                        <div class="number">
                            <label class="fw-bold" for="">**** **** **** 1060</label>
                        </div>
                        <div class="d-flex align-items-center justify-content-between">
                            <small><span class="fw-bold">Expiry date:</span><span>10/16</span></small>
                            <small><span class="fw-bold"></span><span>VISA</span></small>
                        </div>
                    </div>
                </a>
                </div>
               



               
            </div>
        </div>
   @include('payments.payments_footer')