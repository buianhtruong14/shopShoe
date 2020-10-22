<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Cart;
session_start();

class CheckoutController extends Controller
{
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return redirect('dashboard');
        } else {
            return redirect('admin')->send();
        }
    }

    public function loginCheckout(){
        $category_product = DB::table('category_product')->where('category_status',1)->orderby('category_id','desc')->get();

        $brand_product = DB::table('brand_product')->where('brand_status',1)->orderby('brand_id','desc')->get();
        
        return view('page.login')->with('category_product', $category_product)
                                    ->with('brand_product', $brand_product);
    }

    public function addCustomer(Request $request){
        $data = array();
        $data['customer_name'] = $request->customer_name;
        $data['customer_email'] = $request->customer_email;
        $data['customer_phone'] = $request->customer_phone;
        $data['customer_password'] = md5($request->customer_password);
        
        $customer_id = DB::table('customer')->insertGetId($data);

        Session::put('customer_id',$customer_id);
        Session::put('customer_name',$request->customer_name);
        Session::put('message','Đăng ký thành công');
        return redirect('checkout');
    }

    public function register(){
        $category_product = DB::table('category_product')->where('category_status',1)->orderby('category_id','desc')->get();

        $brand_product = DB::table('brand_product')->where('brand_status',1)->orderby('brand_id','desc')->get();
        
        return view('page.register')->with('category_product', $category_product)
                                    ->with('brand_product', $brand_product);
    }

    public function checkout()
    {
        $category_product = DB::table('category_product')->where('category_status',1)->orderby('category_id','desc')->get();

        $brand_product = DB::table('brand_product')->where('brand_status',1)->orderby('brand_id','desc')->get();
        
        return view('page.checkout')->with('category_product', $category_product)
                                    ->with('brand_product', $brand_product);
    }

    public function saveCheckoutCustomer(Request $request){
        $data = array();
        $data['shiping_name'] = $request->shiping_name;
        $data['shiping_email'] = $request->shiping_email;
        $data['shiping_phone'] = $request->shiping_phone;
        $data['shiping_address'] = $request->shiping_address;
        $data['customer_id'] = Session::get('customer_id');
        
        $shiping_id = DB::table('shiping')->insertGetId($data);

        Session::put('shiping_id',$shiping_id);
        Session::put('message','Đăng ký thành công');
        return redirect('payment');
    }

    public function payment(){
        $category_product = DB::table('category_product')->where('category_status',1)->orderby('category_id','desc')->get();

        $brand_product = DB::table('brand_product')->where('brand_status',1)->orderby('brand_id','desc')->get();
        
        return view('page.payment')->with('category_product', $category_product)
                                    ->with('brand_product', $brand_product);
    }

    public function logoutCheckout(){
        Session::flush();
        return redirect('trang-chu');
    }

    public function loginCustomer(Request $request){
        $email = $request->customer_email;
        $password = md5($request->customer_password);
        $result = DB::table('customer')->where('customer_email',$email)->where('customer_password',$password)->first();
        if($result){
            Session::put('customer_id',$result->customer_id);
            return redirect('checkout');
        } else {
            return redirect('login-checkout');
        }
    }

    public function orderPlace(Request $request){
        //insert payment method
        $data = array();
        $data['payment_method'] = $request->payment_option;
        $data['payment_status'] = 'Đang chờ xử lý';
        
        $payment_id = DB::table('payment')->insertGetId($data);

        //insert order
        $order_data = array();
        $order_data['customer_id'] = Session::get('customer_id');
        $order_data['shipping_id'] = Session::get('shiping_id');
        $order_data['payment_id'] = $payment_id;
        $order_data['order_total'] = Cart::total();
        $order_data['order_status'] = 'Đang chờ xử lý';
        
        $order_id = DB::table('order')->insertGetId($order_data);

        //insert order_detail
        $content = Cart::content();
        foreach($content as $v_content){
            $order_d_data = array();
            $order_d_data['product_id'] = $v_content->id;
            $order_d_data['order_id'] = $order_id;
            $order_d_data['product_name'] = $v_content->name;
            $order_d_data['product_price'] = $v_content->price;
            $order_d_data['product_sales_quantity'] = $v_content->qty;
            $order_d_id = DB::table('order_detail')->insert($order_d_data);
        }

        if($data['payment_method']==1){
            echo "thanh toán thẻ ATM";
        } else {
            $category_product = DB::table('category_product')->where('category_status',1)->orderby('category_id','desc')->get();

            $brand_product = DB::table('brand_product')->where('brand_status',1)->orderby('brand_id','desc')->get();
            
            return view('page.handcash')->with('category_product', $category_product)
                                        ->with('brand_product', $brand_product);
            
        }
        
    }

    public function manageOrder(){
        $this->AuthLogin();
        $all_order = DB::table('order')->join('customer','order.customer_id','=','customer.customer_id')
                                       ->select('order.*','customer.customer_name')
                                       ->orderBy('order.order_id','desc')->get();
        // $manager_order = view('admin')
        return view('admin.manage_order')->with('all_order', $all_order);
    }

    public function viewOrder($orderId){
        $this->AuthLogin();
        $order_by_id = DB::table('order')->where('order_id',$orderId)->get();
        foreach($order_by_id as $order){
        $customer_order = DB::table('customer')->where('customer_id',$order->customer_id)->get();
        $shiping_order = DB::table('shiping')->where('shiping_id',$order->shipping_id)->get();
        $order_detail = DB::table('order_detail')->where('order_id',$orderId)->get();
        }
        


        // 
        
                                                                         
        // $manager_order = view('admin')
        // $order1 = DB::table('order')->pluck('shipping_id');
        // $this->p($order_by_id);
        return view('admin.view_order')->with('order_by_id', $order_by_id)
                                       ->with('customer_order', $customer_order)
                                       ->with('shiping_order', $shiping_order)
                                       ->with('order_detail', $order_detail);

    }
}

