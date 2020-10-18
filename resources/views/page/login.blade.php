@extends('layout')
@section('page_content')
<div class="login">
    <div class="container">
    <h2>Đăng Nhập</h2>
    <form action="{{URL::to('/login-customer')}}" method="post">
        {{ csrf_field() }}
			<input type="email" class="ggg" name="customer_email" placeholder="E-MAIL" required="">
			<input type="password" class="ggg" name="customer_password" placeholder="PASSWORD" required="">
			<span><input type="checkbox" />Nhớ Đăng Nhập</span>
			<h6><a href="#">Quên Mật Khẩu</a></h6>
			<h6><a href="{{URL::to('/register')}}">Đăng Ký</a></h6>
			<div class="clearfix"></div>
			<input type="submit" value="Đăng Nhập" name="login">
		</form>
    </div>
</div>
@endsection