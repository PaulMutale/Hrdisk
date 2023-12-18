@include('payments.payments_header')

<div class="col-12">
    <div class="card p-3">
        <div class="card-body border p-0">
            
            <div class="collapse p-3 pt-0" id="collapseExample">
                <div class="row">
                    <div class="col-8">
                        <p class="h4 mb-0">Summary</p>
                        <p class="mb-0"><span class="fw-bold">Product:</span><span class="c-green">Subscription</span></p>
                        <p class="mb-0"><span class="fw-bold">Price:</span><span
                                class="c-green">$5</span></p>
                        <p class="mb-0">This is the monthly subscription fee for the hrdisk at E-systems................</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body border p-0">
            <p>
                <a class="btn btn-primary p-2 w-100 h-100 d-flex align-items-center justify-content-between"
                    data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="true"
                    aria-controls="collapseExample">
                    <span class="fw-bold">Visa Debit Card</span>
                    <span class="">
                        <span class="fab fa-cc-amex"></span>
                        <span class="fab fa-cc-mastercard"></span>
                        <span class="fab fa-cc-discover"></span>
                    </span>
                </a>
            </p>
            <div class="collapse show p-3 pt-0" id="collapseExample">
                <div class="row">
                    <div class="col-lg-5 mb-lg-0 mb-3">
                        <p class="h4 mb-0">Summary</p>
                        <p class="mb-0"><span class="fw-bold">Product:</span><span class="c-green">: Subscription</span>
                        </p>
                        <p class="mb-0">
                            <span class="fw-bold">Price:</span>
                            <span class="c-green">$5</span>
                        </p>
                        <p class="mb-0">This is the monthly subscription fee for the hrdisk at E-systems................</p>
                    </div>
                    <div class="col-lg-7">
                        <form action="" class="form">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form__div">
                                        <input type="text" class="form-control" placeholder=" ">
                                        <label for="" class="form__label">Card Number</label>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form__div">
                                        <input type="text" class="form-control" placeholder=" ">
                                        <label for="" class="form__label">MM / yy</label>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form__div">
                                        <input type="password" class="form-control" placeholder=" ">
                                        <label for="" class="form__label">cvv code</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form__div">
                                        <input type="text" class="form-control" placeholder=" ">
                                        <label for="" class="form__label">name on the card</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="btn btn-primary w-100">Sumbit</div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('payments.payments_footer')