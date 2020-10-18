<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Cart;
session_start();

class CartController extends Controller
{
    public function saveCart(Request $request){
       $productID = $request->product_id_hidden;
       $quantity = $request->quantity;
       $product_info = DB::table('product')->where('product_id',$productID)->first();
       $data['id'] = $productID;
       $data['qty'] = $quantity;
       $data['name'] = $product_info->product_name;
       $data['price'] = $product_info->product_price;
       $data['weight'] = $product_info->product_price;
       $data['options']['image'] = $product_info->product_image;
       Cart::add($data);

       return redirect('show-cart');
                                

    }

    public function showCart(){
        $category_product = DB::table('category_product')->where('category_status',1)->orderby('category_id','desc')->get();

        $brand_product = DB::table('brand_product')->where('brand_status',1)->orderby('brand_id','desc')->get();

        return view('page.show_cart')->with('category_product', $category_product)
                                    ->with('brand_product', $brand_product);
    }

    public function deleteToCart($rowId){
        Cart::update($rowId,0);
        return redirect('show-cart');
    }

    public function updateCartQuantity(Request $request){
        $rowId = $request->rowId_cart;
        $qty = $request->cart_quantity;
        Cart::update($rowId,$qty);
        return redirect('show-cart');
    }
    

}