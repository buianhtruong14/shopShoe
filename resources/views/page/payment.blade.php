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

            <div class="col-lg-4">
                <div class="row">
                    <div class="col-md-12">
                        <div class="cart-detail">
                            <h2>Cart Total</h2>
                            <ul>
                                <li>
                                    <ul>
                                    <?php
                                        $content = Cart::content();
                                    ?>
                                    @foreach($content as $key => $cart)
                                        <li><span>{{$cart->qty}} x {{$cart->name}}</span> <span>{{$cart->qty}} x {{$cart->price}}đ</span></li>
                                    @endforeach
                                    </ul>
                                    
                                </li>
                                <li><span>Tổng</span> <span>{{Cart::subtotal()}} đ</span></li>
                                <li><span>Thuế</span> <span>{{Cart::tax()}} đ</span></li>
                                <li><span>Phí ship</span> <span>$0.00</span></li>
                                <li><span>Thành Tiền</span> <span>{{Cart::total()}} đ</span></li>
                            </ul>
                        </div>
                    </div>

                    <div class="w-100"></div>

                    <div class="col-md-12">
                        <div class="cart-detail">
                            <h2>Phương Thức Thanh Toán</h2>
                            <form action="{{URL::to('/order-place')}}" method="post">
                                {{csrf_field()}}
                            <div class="form-group">
                                <div class="col-md-12">
                                    <div class="radio">
                                        <label><input type="radio" value="1" name="payment_option"> Chuyển Khoản</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <div class="radio">
                                        <label><input type="radio" value="2" name="payment_option"> Trả bằng tiền mặt</label>
                                    </div>
                                </div>
                            </div>
                            <input type="submit" class="btn btn-primary" value="Đặt Hàng" name="send_order">
                            </form>
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