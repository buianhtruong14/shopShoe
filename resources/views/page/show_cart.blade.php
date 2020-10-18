@extends('layout')
@section('page_content')
<div class="breadcrumbs">
			<div class="container">
				<div class="row">
					<div class="col">
						<p class="bread"><span><a href="index.html">Home</a></span> / <span>Shopping Cart</span></p>
					</div>
				</div>
			</div>
		</div>


		<div class="colorlib-product">
			<div class="container">
				<div class="row row-pb-lg">
					<div class="col-md-10 offset-md-1">
						<div class="process-wrap">
							<div class="process text-center active">
								<p><span>01</span></p>
								<h3>Shopping Cart</h3>
							</div>
							<div class="process text-center">
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
                <?php
                    $content = Cart::content();
                ?>
				<div class="row row-pb-lg">
					<div class="col-md-12">
						<div class="product-name d-flex">
							<div class="one-forth text-left px-4">
								<span>Product Details</span>
							</div>
							<div class="one-eight text-center">
								<span>Price</span>
							</div>
							<div class="one-eight text-center">
								<span>Quantity</span>
							</div>
							<div class="one-eight text-center">
								<span>Total</span>
							</div>
							<div class="one-eight text-center px-4">
								<span>Remove</span>
							</div>
                        </div>
                        @foreach($content as $key => $cart)
						<div class="product-cart d-flex">
							<div class="one-forth">
								<div class="product-img" style="background-image: url(http://localhost/shopShoe/public/uploads/products/{{$cart->options->image}});">
								</div>
								<div class="display-tc">
									<h3>{{$cart->name}}</h3>
								</div>
							</div>
							<div class="one-eight text-center">
								<div class="display-tc">
									<span class="price">{{ number_format($cart->price) }} VNĐ</span>
								</div>
							</div>
							<div class="one-eight text-center">
								<div class="display-tc">
                                    <form action="{{URL::to('update-cart-quantity')}}" method="post">
                                        {{ csrf_field()}}
                                        <input type="text" id="quantity" name="cart_quantity" class="form-control input-number text-center" value="{{$cart->qty}}" min="1" max="100">
                                        <input type="hidden"  name="rowId_cart" class="form-control input-number text-center" value="{{$cart->rowId}}" >
                                        <input type="submit" value="Cập Nhật" name="update_quantity" class="btn btn-default btn-sm" >
                                    </form>
                                </div>
							</div>
							<div class="one-eight text-center">
								<div class="display-tc">
									<span class="price">
                                    <?php
                                        $subtotal_product = $cart->price*$cart->qty;
                                        echo $subtotal_product;
                                    ?>    
                                    VNĐ</span>
								</div>
							</div>
							<div class="one-eight text-center">
								<div class="display-tc">
									<a href="{{URL::to('delete-to-cart/'.$cart->rowId)}}" class="closed"></a>
								</div>
							</div>
						</div>
						@endforeach
					</div>
				</div>
				<div class="row row-pb-lg">
					<div class="col-md-12">
						<div class="total-wrap">
							<div class="row">
								<div class="col-sm-8">
									<form action="#">
										<div class="row form-group">
											<div class="col-sm-9">
												<input type="text" name="quantity" class="form-control input-number" placeholder="Your Coupon Number...">
											</div>
											<div class="col-sm-3">
												<input type="submit" value="Apply Coupon" class="btn btn-primary">
											</div>
										</div>
									</form>
								</div>
								<div class="col-sm-4 text-center">
									<div class="total">
										<div class="sub">
											<p><span>Tổng:</span> <span>{{Cart::subtotal()}} VNĐ</span></p>
											<p><span>Thuế:</span> <span>{{Cart::tax()}} VNĐ</span></p>
											<p><span>Phí Vận Chuyển:</span> <span> Freee </span></p>
											<p><span>Khuyến Mãi:</span> <span>$00.00</span></p>
										</div>
										<div class="grand-total">
											<p><span><strong>Thành Tiền:</strong></span> <span>{{Cart::total()}} VNĐ</span></p>
                                        </div>
            
                                        <?php 
                                            $customer_id = Session::get('customer_id');
                                            if($customer_id != null){
                                        ?>
                                            <a class = "btn btn-defaul check-out" href="{{URL::to('checkout')}}"> Thanh Toán </a>
                                        <?php
                                            } else {
                                        ?>
                                            <a class = "btn btn-defaul check-out" href="{{URL::to('login-checkout')}}"> Thanh Toán </a>
                                        <?php
                                            }
                                        ?>
                                        
                                        
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-sm-8 offset-sm-2 text-center colorlib-heading colorlib-heading-sm">
						<h2>Related Products</h2>
					</div>
				</div>
				<div class="row">
					<div class="col-md-3 col-lg-3 mb-4 text-center">
						<div class="product-entry border">
							<a href="#" class="prod-img">
								<img src="images/item-1.jpg" class="img-fluid" alt="Free html5 bootstrap 4 template">
							</a>
							<div class="desc">
								<h2><a href="#">Women's Boots Shoes Maca</a></h2>
								<span class="price">$139.00</span>
							</div>
						</div>
					</div>
					<div class="col-md-3 col-lg-3 mb-4 text-center">
						<div class="product-entry border">
							<a href="#" class="prod-img">
								<img src="images/item-2.jpg" class="img-fluid" alt="Free html5 bootstrap 4 template">
							</a>
							<div class="desc">
								<h2><a href="#">Women's Minam Meaghan</a></h2>
								<span class="price">$139.00</span>
							</div>
						</div>
					</div>
					<div class="col-md-3 col-lg-3 mb-4 text-center">
						<div class="product-entry border">
							<a href="#" class="prod-img">
								<img src="images/item-3.jpg" class="img-fluid" alt="Free html5 bootstrap 4 template">
							</a>
							<div class="desc">
								<h2><a href="#">Men's Taja Commissioner</a></h2>
								<span class="price">$139.00</span>
							</div>
						</div>
					</div>
					<div class="col-md-3 col-lg-3 mb-4 text-center">
						<div class="product-entry border">
							<a href="#" class="prod-img">
								<img src="images/item-4.jpg" class="img-fluid" alt="Free html5 bootstrap 4 template">
							</a>
							<div class="desc">
								<h2><a href="#">Russ Men's Sneakers</a></h2>
								<span class="price">$139.00</span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

@endsection