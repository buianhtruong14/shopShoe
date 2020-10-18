@extends('layout')
@section('page_content')
<div class="breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col">
                <p class="bread"><span><a href="index.html">Home</a></span> / <span>Checkout</span></p>
            </div>
        </div>
    </div>
</div>


<div class="colorlib-product">
    <div class="container">
        <div class="row row-pb-lg">
            <div class="col-sm-10 offset-md-1">
                <div class="process-wrap">
                    <div class="process text-center active">
                        <p><span>01</span></p>
                        <h3>Shopping Cart</h3>
                    </div>
                    <div class="process text-center active">
                        <p><span>02</span></p>
                        <h3>Checkout</h3>
                    </div>
                    <div class="process text-center">
                        <p><span>03</span></p>
                        <h3>Order Complete</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8">
                <form action="{{URL::to('/save-checkout-customer')}}" method="post" class="colorlib-form">
                    {{csrf_field()}}
                    <h2>Thông Tin Gửi Hàng</h2>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="companyname">Họ Và Tên</label>
                                <input type="text" id="companyname" name="shiping_name" class="form-control" placeholder="Họ Và Tên">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="companyname">Email</label>
                                <input type="text" id="companyname" name="shiping_email" class="form-control" placeholder="Email">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="companyname">Địa chỉ</label>
                                <input type="text" id="companyname" name="shiping_address" class="form-control" placeholder="Địa chỉ">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="companyname">Điện Thoại</label>
                                <input type="text" id="companyname" name="shiping_phone" class="form-control" placeholder="Điện Thoại">
                            </div>
                        </div>

                        <input type="submit" id="companyname" name="send_order" class="btn btn-primary " value="Gửi">
                    </div>
                </form>
            </div>

            <div class="col-lg-4">
                <div class="row">
                    <div class="col-md-12">
                        <div class="cart-detail">
                            <h2>Cart Total</h2>
                            <ul>
                                <li>
                                    <span>Subtotal</span> <span>$100.00</span>
                                    <ul>
                                        <li><span>1 x Product Name</span> <span>$99.00</span></li>
                                        <li><span>1 x Product Name</span> <span>$78.00</span></li>
                                    </ul>
                                </li>
                                <li><span>Shipping</span> <span>$0.00</span></li>
                                <li><span>Order Total</span> <span>$180.00</span></li>
                            </ul>
                        </div>
                    </div>

                    <div class="w-100"></div>

                    <div class="col-md-12">
                        <div class="cart-detail">
                            <h2>Payment Method</h2>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <div class="radio">
                                        <label><input type="radio" name="optradio"> Direct Bank Tranfer</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <div class="radio">
                                        <label><input type="radio" name="optradio"> Check Payment</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <div class="radio">
                                        <label><input type="radio" name="optradio"> Paypal</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <div class="checkbox">
                                        <label><input type="checkbox" value=""> I have read and accept the terms and conditions</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <div class="row">
                    <div class="col-md-12 text-center">
                        <p><a href="#" class="btn btn-primary">Place an order</a></p>
                    </div>
                </div> -->
            </div>
        </div>
    </div>
</div>
@endsection