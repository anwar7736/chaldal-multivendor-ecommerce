@extends('frontend.app')
@section('title', 'Home')
@push('css')
    <link rel="stylesheet" href="{{ asset('frontend/css/checkout.css') }}">
@endpush
@section('content')
<div class="main-wrapper">
        <section class="bodyTable">
            <div>
                <div class="checkoutExperience2">
                    <div class="loaded">
                        <div>
                            <div class="checkoutDelivery">
                                <div class="deliveryStep">
                                    <div class="deliveryStepTitle">
                                        <div class="titleLeft">
                                            <div class="stepIcon">
                                                <svg style="fill:#214354;stroke:#214354;display:inline-block;vertical-align:middle;" width="25px" height="25px" x="0px" y="0px" viewBox="0 0 500 500">
                                                    <g>
                                                        <path d="M418.455,188.455C418.455,95.418,343.037,20,250.001,20   C156.964,20,81.546,95.418,81.546,188.455c0,33.983,10.074,65.614,27.383,92.079h-0.298l126.278,201.831h0.005   c2.759,5.539,8.479,9.349,15.087,9.349c6.607,0,12.327-3.811,15.085-9.349h0.006l126.279-201.831h-0.299   C408.382,254.068,418.455,222.438,418.455,188.455L418.455,188.455 M250.001,111.641c42.425,0,76.814,34.389,76.814,76.814   c0,42.426-34.389,76.814-76.814,76.814s-76.815-34.389-76.815-76.814C173.187,146.03,207.575,111.641,250.001,111.641   L250.001,111.641 M250.001,111.641L250.001,111.641z"></path>
                                                    </g>
                                                </svg>
                                            </div>
                                            <h2>Delivery Address</h2>
                                        </div>
                                    </div>
                                    <div class="deliveryStepContent">
                                        <div class="addressComponent mui">
                                            <div class="theSelectedAddress">
                                                <div class="wholeAddress">
                                                    <span class="wrap">
                                                        <span>n</span>
                                                        <span> </span>
                                                        <br>
                                                        <span> </span>
                                                        <span>Mohammadpur, Dhaka</span>
                                                        <span> </span>
                                                        <span></span>
                                                    </span>
                                                </div>
                                                <div class="stepAction">
                                                    <button>Change</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="placeOrderFooter">
                                    <div class="paymentMethodInstruction">
                                        <span>Payment options available on the next page</span>
                                    </div>
                                    <div class="confirmBtnContainer">
                                        <p class="footNote">
                                            <span>
                                                <span>৳</span>
                                                <span>0</span>
                                                <span> </span>
                                            </span>
                                            <span>Delivery charge included</span>
                                        </p>
                                        <button class="confirmBtn confirmOrder">
                                            <div>
                                                <div class="placeOrderText">Proceed</div>
                                                <div class="placeOrderPrice">
                                                    <span>৳ </span>
                                                    <span>969</span>
                                                </div>
                                            </div>
                                        </button>
                                        <p class="termConditionText">
                                            <span>By clicking/tapping proceed, I agree to Chaldal's 
                                                <a href="/t/TermsOfUse" target="_blank">Terms of Services</a>
                                            </span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!-- Modal -->

    @endsection

