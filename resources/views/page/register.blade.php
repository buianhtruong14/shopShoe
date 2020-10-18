@extends('layout')
@section('page_content')
<div class="login">
    <div class="container">
        <h2>Đăng Ký</h2>
    <form action="{{URL::to('/add-customer')}}" method="post">
        {{ csrf_field() }}
			<input type="text" class="ggg" name="customer_name" placeholder="Họ Và Tên" required="">
			<input type="email" class="ggg" name="customer_email" placeholder="E-MAIL" required="">
			<input type="text" class="ggg" name="customer_phone" placeholder="Điện Thoại" required="">
			<input type="password" class="ggg" name="customer_password" placeholder="Mật Khẩu" required="">	
			<input type="submit" value="Đăng Ký" name="register">
		</form>
    </div>
</div>
@endsection