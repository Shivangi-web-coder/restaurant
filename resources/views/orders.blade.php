<section class="section" id="orders">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 align-self-center">
                <div class="contact-form">
                    <form id="ordernow" action="{{url('orderconfirm')}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-lg-12">
                                <h4>Please Fill The Form</h4>
                            </div>
                            @foreach($cartData as $ct)
                            <div class="col-lg-12">
                                <input name="cart_id[]" type="hidden" value="{{$ct->cart_id}}">
                                <input name="price[]" type="hidden" value="{{$ct->price}}">
                                <input name="total_quantity[]" type="hidden" value="{{$ct->total_quantity}}">
                            </div>
                            @endforeach
                            <div class="col-lg-12">
                                <fieldset>
                                    <input name="name" type="text" id="name" placeholder="Your Name*" required="">
                                </fieldset>
                            </div>
                            <div class="col-lg-12">
                                <fieldset>
                                    <input name="email" type="text" id="email" pattern="[^ @]*@[^ @]*" placeholder="Your Email Address" required="">
                                </fieldset>
                            </div>
                            <div class="col-lg-12">
                                <fieldset>
                                    <input name="phone" type="text" id="phone" placeholder="Phone Number*" required="">
                                </fieldset>
                            </div>
                            <div class="col-lg-12">
                                <fieldset>
                                    <input name="address" type="text" id="address" placeholder="Address" required="">
                                </fieldset>
                            </div>
                            <div class="col-lg-6">
                                <fieldset>
                                    <button type="submit" class="order_confirm">Order Confirm</button>
                                </fieldset>
                            </div>
                            <div class="col-lg-6">
                                <fieldset>
                                    <button type="button" class="order_close">Close</button>
                                </fieldset>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>