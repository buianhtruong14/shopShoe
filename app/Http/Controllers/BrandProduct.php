<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
session_start();

class BrandProduct extends Controller
{
    public function addBrandProduct(){
        return view('admin.addBrandProduct');
    }

    public function allBrandProduct(){
        $all_brand_product = DB::table('brand_product')->get();
        return view('admin.allBrandProduct')->with('all_brand_product', $all_brand_product);
    }

    public function saveBrandProduct(Request $request){
        $data = array();
        $data['brand_name'] = $request->brand_product_name;
        $data['brand_desc'] = $request->brand_product_desc;
        $data['brand_status'] = $request->brand_product_status;

        DB::table('brand_product')->insert($data);
        Session::put('message','Thêm Thương Hiệu thành công vào danh mục');

        return redirect('add-brand-product');
    }

    public function activeBrandProduct($brand_product_id){
        DB::table('brand_product')->where('brand_id', $brand_product_id)->update(['brand_status'=> 1]);
        Session::put('message','Kích hoạt thành công');
        return redirect('all-brand-product');
    }

    public function unactiveBrandProduct($brand_product_id){
        DB::table('brand_product')->where('brand_id', $brand_product_id)->update(['brand_status' => 0]);
        Session::put('message','Bỏ kích hoạt thành công');
        return redirect('all-brand-product');
    }

    public function editBrandProduct($brand_product_id){
        $edit_brand_product = DB::table('brand_product')->where('brand_id', $brand_product_id)->get();
        return view('admin.editbrandProduct')->with('edit_brand_product', $edit_brand_product);
    }

    public function updateBrandProduct(Request $request,$brand_product_id){
        $data = array();
        $data['brand_name'] = $request->brand_product_name;
        $data['brand_desc'] = $request->brand_product_desc;
        DB::table('brand_product')->where('brand_id', $brand_product_id)->update($data);
        Session::put('message','Cập nhật Thương Hiệu thành công');
        return redirect('all-brand-product');
    }

    public function deleteBrandProduct($brand_product_id){
        DB::table('brand_product')->where('brand_id', $brand_product_id)->delete();
        Session::put('message','Xóa Thương Hiệu thành công');
        return redirect('all-brand-product');
    }
}
