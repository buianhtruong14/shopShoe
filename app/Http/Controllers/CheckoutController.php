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
        $data['shiping_password'] = $request->shiping_password;
        $data['customer_id'] = Session::get('customer_id');
        
        $shiping_id = DB::table('shiping')->insertGetId($data);

        Session::put('shiping_id',$shiping_id);
        Session::put('message','Đăng ký thành công');
        return redirect('payment');
    }

    public function payment(){

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
}
