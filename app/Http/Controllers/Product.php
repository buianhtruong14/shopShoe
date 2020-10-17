<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
session_start();

class Product extends Controller
{
    public function addProduct(){
        $category_product = DB::table('category_product')->orderby('category_id','desc')->get();
        $brand_product = DB::table('brand_product')->orderby('brand_id','desc')->get();
        return view('admin.addProduct')->with('category_product', $category_product)->with('brand_product', $brand_product);
    }

    public function allProduct(){
        $all_product = DB::table('product')->get();
        return view('admin.allProduct')->with('all_product', $all_product);
    }

    public function saveProduct(Request $request){
        $data = array();
        $data['product_name'] = $request->product_name;
        $data['product_desc'] = $request->product_desc;
        $data['product_status'] = $request->product_status;

        DB::table('product')->insert($data);
        Session::put('message','Thêm Thương Hiệu thành công vào danh mục');

        return redirect('add-product');
    }

    public function activeProduct($product_id){
        DB::table('product')->where('product_id', $product_id)->update(['product_status'=> 1]);
        Session::put('message','Kích hoạt thành công');
        return redirect('all-product');
    }

    public function unactiveProduct($product_id){
        DB::table('product')->where('product_id', $product_id)->update(['product_status' => 0]);
        Session::put('message','Bỏ kích hoạt thành công');
        return redirect('all-product');
    }

    public function editProduct($product_id){
        $edit_product = DB::table('product')->where('product_id', $product_id)->get();
        return view('admin.editProduct')->with('edit_product', $edit_product);
    }

    public function updateProduct(Request $request,$product_id){
        $data = array();
        $data['product_name'] = $request->product_name;
        $data['product_desc'] = $request->product_desc;
        DB::table('product')->where('product_id', $product_id)->update($data);
        Session::put('message','Cập nhật Thương Hiệu thành công');
        return redirect('all-product');
    }

    public function deleteProduct($product_id){
        DB::table('product')->where('product_id', $product_id)->delete();
        Session::put('message','Xóa Thương Hiệu thành công');
        return redirect('all-product');
    }
}
