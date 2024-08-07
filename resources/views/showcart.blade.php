@include('header')
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
                        <article id='tabs-1'>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="row">
                                        <?php $total_amount=0;?>
                                        @foreach($cartData as $ct)
                                        <div class="col-lg-6">
                                            <div class="tab-item">
                                                <img src="/foodimage/{{$ct->image}}" alt="" class="food_img">
                                                <h4>{{$ct->title}} - <span class="badge bg-secondary">{{$ct->total_quantity}}</span> <a href="{{url('/removecart',$ct->cart_id)}}"><i class="fa fa-trash" aria-hidden="true"></i></a></h4>
                                                <p>{{$ct->description}}</p>
                                                <span class="price">
                                                    <?php $total_price = ($ct->price * $ct->total_quantity); ?>
                                                    <?php $total_amount += $total_price; ?>
                                                    <h6>${{$total_price}}</h6>
                                                </span>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <form action="{{url('payment')}}" method="post">
                            @csrf
                                <div class="row">
                                    <div class="col-lg-12">
                                        <input type="hidden" name="total_amount" id="total_amount" value="{{$total_amount}}">
                                    </div>
                                    <div class="col-lg-12">
                                        <center><input type="submit" class="order_now" value="Order Now"></center>
                                    </div>
                                </div>
                            </form>
                                {{-- <div class="col-lg-6">
                                    @include('orders')
                                </div> --}}
                            </div>
                        </article>
                    </section>
                </div>
            </div>
        </div>
    </section>
</body>
@include('footer')
{{-- <script type="text/javascript">
    $('#orders').hide();
    $('.order_close').hide();
    $('.order_now').click(function() {
        $('#orders').show();
        $('.order_close').show();
        $('.order_now').hide();
    });

    $('.order_close').click(function() {
        $('#orders').hide();
        $('.order_close').hide();
        $('.order_now').show();
    });
</script> --}}