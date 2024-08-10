@include('header')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" />

<style>
    .food_img {
        width: 100px !important;
        height: 100px !important;
    }

    .cart-text {
        color: #fb5849;
    }
</style>

<body>

    <!-- ***** Preloader Start ***** -->
    <div id="preloader">
        <div class="jumper">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>
    <!-- ***** Preloader End ***** -->


    <!-- ***** Header Area Start ***** -->
    <header class="header-area header-sticky">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="main-nav">
                        <!-- ***** Logo Start ***** -->
                        <a href="{{ url('/') }}" class="logo">
                            <img src="assets/images/klassy-logo.png" align="klassy cafe">
                        </a>
                        <!-- ***** Logo End ***** -->
                        <!-- ***** Menu Start ***** -->
                        <ul class="nav">
                            <li class="scroll-to-section"><a href="{{url('/')}}" class="active">Home</a></li>
                            <li class="scroll-to-section"><a href="#about">About</a></li>
                            <li class="scroll-to-section"><a href="#menu">Menu</a></li>
                            <li class="scroll-to-section"><a href="#chefs">Chefs</a></li>
                            <li class="scroll-to-section"><a href="#reservation">Contact Us</a></li>
                            <li class="scroll-to-section">
                                @if($count>0)
                                <a href="{{url('/showcart',Auth::user()->id)}}" style="color:#fb5849;">Cart[{{$count}}]</a>
                                @else
                                <span style="color:#fb5849;">Cart[0]</span>
                                @endif
                            </li>
                            <li>
                                @if (Route::has('login'))
                                <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                                    @auth
                            <li><x-app-layout></x-app-layout></li>
                            @else
                            <li><a href="{{ route('login') }}" class="text-sm text-gray-700 underline">Log in</a></li>
                            @if (Route::has('register'))
                            <li><a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 underline">Register</a></li>
                            @endif
                            @endauth
                </div>
                @endif
                </li>
                </ul>
                </nav>
            </div>
        </div>
        </div>
    </header>
    <!-- ***** Header Area End ***** -->
    <section class="section" id="offers">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <section class='tabs-content'>
                        <article>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="row">
                                        <?php $cartArr=[];?>
                                        @foreach($cartData as $ct)
                                        <?php $grand_total=$ct->grand_total;
                                        array_push($cartArr,$ct->cart_id);
                                        $cartId=json_encode($cartArr);?>
                                        <div class="col-lg-6">
                                            <div class="tab-item">
                                                <img src="/foodimage/{{$ct->image}}" alt="" class="food_img">
                                                <h4>{{$ct->title}} - <span class="badge bg-secondary">{{$ct->total_quantity}}</span> <a href="{{url('/removecart',$ct->cart_id)}}"><i class="fa fa-trash" aria-hidden="true"></i></a></h4>
                                                <p>{{$ct->description}}</p>
                                                <span class="price">
                                                    <h6>${{$ct->total_amount}}</h6>
                                                </span>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="col-lg-2"></div>
                                <div class="col-lg-4">
                                    <center><button type="button" class="order_now paypalBtn">Order Using Paypal</button></center>
                                </div>
                                <div class="col-lg-4">
                                    <center><button type="button" class="order_now stripeBtn">Order Using Stripe</button></center>
                                </div>
                            </div>
                        </article>
                    </section>
                </div>
            </div>
            {{-- paypal payment gateway form --}}
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <i class="fa fa-times pull-right" id="paypalCloseBtn"></i> 
                    <form class="form-horizontal" method="GET" id="paypalForm" role="form" action="{{ route('processTransaction') }}">
                       @csrf
                       <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="amount" class="form-label">Grand Total (In USD)</label>
                                        <input type="hidden" name="cart_id" value="{{$cartId}}">
                                        <input type="text" class="form-control" name="amount" value="{{ $grand_total }}" readonly>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                    <center><button class="btn btn-success" type="submit">Pay Now (${{ $grand_total }})</button></center>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            {{-- stripe payment gateway form --}}
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <i class="fa fa-times pull-right" id="stripeCloseBtn"></i> 
                    <form 
                        id="stripeForm"
                            role="form" 
                            action="{{ route('stripe.post') }}" 
                            method="post" 
                            class="require-validation"
                            data-cc-on-file="false"
                            data-stripe-publishable-key="{{ env('STRIPE_KEY') }}"
                            id="payment-form">
                        @csrf
                        <input type='hidden' name="total_amount" value="{{ $grand_total }}">
                        <input type="hidden" name="cart_id" value="{{$cartId}}">
                        <div class='row'>
                            <div class='col-lg-12 form-group required'>
                                <label class='control-label'>Name on Card</label> <input
                                    class='form-control' size='4' type='text' name="card_holder">
                            </div>
                      
                            <div class='col-lg-12 form-group card required'>
                                <label class='form-label'>Card Number</label> <input
                                    autocomplete='off' class='form-control card-number' size='20'
                                    type='text' name="card_number">
                            </div>
                            <div class='col-lg-12 form-group cvc required'>
                                <label class='form-label'>CVC</label> <input autocomplete='off'
                                    class='form-control card-cvc' placeholder='ex. 311' size='4'
                                    type='text' name="cvc">
                            </div>
                            <div class='col-lg-12 form-group expiration required'>
                                <label class='form-label'>Expiration Month</label> <input
                                    class='form-control card-expiry-month' placeholder='MM' size='2'
                                    type='text' name="expiration_month">
                            </div>
                            <div class='col-lg-12 form-group expiration required'>
                                <label class='form-label'>Expiration Year</label> <input
                                    class='form-control card-expiry-year' placeholder='YYYY' size='4'
                                    type='text' name="expiration_year">
                            </div>
                        </div>

                        <div class='row'>
                            <div class='col-lg-12 error form-group hide'>
                                <div class='alert-danger alert'>Please correct the errors and try
                                    again.</div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <button class="btn btn-success btn-block" type="submit">Pay Now (${{ $grand_total }})</button>
                            </div>
                            <div class="col-md-6">
                                <button class="btn btn-danger btn-block resetStripeBtn" type="button">Cancel</button>
                            </div>
                        </div>
                            
                    </form>
                </div>
            </div>
        </div>
    </section>
</body>
@include('footer')
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script src="assets/js/payment.js"></script>
