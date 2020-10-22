@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Thông tin người mua
    </div>
    <?php
        $message = Session::get('message');
        if ( $message){
            echo '<span class="text-alert">'.$message.'</span>';
            Session::put('message',null);
        }
    ?>
    
    <div class="table-responsive">
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            
            <th>Tên Người Mua</th> 
            <th>Số Điện Thoại</th>
            
          </tr>
        </thead>
        <tbody>
        @foreach($customer_order as $cus_order)
          <tr>          
            <td>{{$cus_order->customer_name}}</td>
            <td>{{$cus_order->customer_phone}}</td>
          </tr>
        @endforeach
        </tbody>
      </table>
    </div>
    
  </div>
</div>
<br>
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Thông tin vận chuyển
    </div>
    <?php
        $message = Session::get('message');
        if ( $message){
            echo '<span class="text-alert">'.$message.'</span>';
            Session::put('message',null);
        }
    ?>
    
    <div class="table-responsive">
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            
            <th>Tên Người Nhận</th> 
            <th>Địa Chỉ</th>
            <th>Số Điện Thoại</th>
            
          </tr>
        </thead>
        <tbody>
        @foreach($shiping_order as $ship_order)
          <tr>          
            <td>{{$ship_order->shiping_name}}</td>
            <td>{{$ship_order->shiping_address}}</td>
            <td>{{$ship_order->shiping_phone}}</td>
            
          </tr>
        @endforeach
        </tbody>
      </table>
    </div>
    
  </div>
</div>
<br><br>
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Liệt Kê Chi Tiết Đơn Hàng
    </div>
    <?php
        $message = Session::get('message');
        if ( $message){
            echo '<span class="text-alert">'.$message.'</span>';
            Session::put('message',null);
        }
    ?>
    
    <div class="table-responsive">
      <table class="table table-striped b-t b-light">
        <thead>
        
          <tr>
            
            <th>Tên Sản Phẩm</th> 
            <th>Số Lượng</th>
            <th>giá</th>
            <th>Tổng Tiền</th>
            
          </tr>
        </thead>
        <tbody>
        @foreach($order_detail as $order_detail)
          <tr>
            
            <td>{{$order_detail->product_name}}</td>
            <td>{{$order_detail->product_sales_quantity}}</td>
            <td>{{$order_detail->product_price}}</td>
            <td>{{$order_detail->product_price*$order_detail->product_sales_quantity}}</td>
            
        @endforeach            
          </tr>
        
        </tbody>
      </table>
    </div>
    <footer class="panel-footer">
      <div class="row">
        
        <div class="col-sm-5 text-center">
          <small class="text-muted inline m-t-sm m-b-sm">showing 20-30 of 50 items</small>
        </div>
        <div class="col-sm-7 text-right text-center-xs">                
          <ul class="pagination pagination-sm m-t-none m-b-none">
            <li><a href=""><i class="fa fa-chevron-left"></i></a></li>
            <li><a href="">1</a></li>
            <li><a href="">2</a></li>
            <li><a href="">3</a></li>
            <li><a href="">4</a></li>
            <li><a href=""><i class="fa fa-chevron-right"></i></a></li>
          </ul>
        </div>
      </div>
    </footer>
  </div>
</div>
@endsection