@extends('layout')
@section('page_content')
<div class="colorlib-product">
    <div class="container">
        <div class="row">
            <div class="col-sm-8 offset-sm-2 text-center colorlib-heading">


                <h2>Kết Quả Tìm Kiếm</h2>

            </div>
        </div>
        <div class="row row-pb-md">
            @foreach($product as $key => $product)
            <div class="col-lg-3 mb-4 text-center">
                <div class="product-entry border">
                    <a href="http://localhost/shopShoe/public/chi-tiet-san-pham/{{$product->product_id}}" class="prod-img">
                        <img src="http://localhost/shopShoe/public/uploads/products/{{$product->product_image}}" class="img-fluid" alt="Free html5 bootstrap 4 template">
                    </a>
                    <div class="desc">
                        <h2><a href="#">{{$product->product_name}}</a></h2>
                        <span class="price">{{number_format($product->product_price)}} VNĐ</span>
                    </div>
                </div>
            </div>
            @endforeach


        </div>
    </div>

    <div class="colorlib-partner">
        <div class="container">
            <div class="row">
                <div class="col-sm-8 offset-sm-2 text-center colorlib-heading colorlib-heading-sm">
                    <h2>Trusted Partners</h2>
                </div>
            </div>
            <div class="row">
                <div class="col partner-col text-center">
                    <img src="{{ asset('footwear/images/brand-1.jpg') }}" class="img-fluid" alt="Free html4 bootstrap 4 template">
                </div>
                <div class="col partner-col text-center">
                    <img src="{{ asset('footwear/images/brand-2.jpg') }}" class="img-fluid" alt="Free html4 bootstrap 4 template">
                </div>
                <div class="col partner-col text-center">
                    <img src="{{ asset('footwear/images/brand-3.jpg') }}" class="img-fluid" alt="Free html4 bootstrap 4 template">
                </div>
                <div class="col partner-col text-center">
                    <img src="{{ asset('footwear/images/brand-4.jpg') }}" class="img-fluid" alt="Free html4 bootstrap 4 template">
                </div>
                <div class="col partner-col text-center">
                    <img src="{{ asset('footwear/images/brand-5.jpg') }}" class="img-fluid" alt="Free html4 bootstrap 4 template">
                </div>
            </div>
        </div>
    </div>
    @endsection