<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
session_start();

class CategoryProduct extends Controller
{
    public function addCategoryProduct(){
        return view('admin.addCategoryProduct');
    }

    public function allCategoryProduct(){
        $all_category_product = DB::table('category_product')->get();
        return view('admin.allCategoryProduct')->with('all_category_product', $all_category_product);
    }

    public function saveCategoryProduct(Request $request){
        $data = array();
        $data['category_name'] = $request->category_product_name;
        $data['category_desc'] = $request->category_product_desc;
        $data['category_status'] = $request->category_product_status;

        DB::table('category_product')->insert($data);
        Session::put('message','Thêm danh mục sản phẩm thành công ! ');

        return redirect('add-category-product');
    }

    public function activeCategoryProduct($category_product_id){
        DB::table('category_product')->where('category_id', $category_product_id)->update(['category_status'=> 1]);
        Session::put('message','Kích hoạt thành công');
        return redirect('all-category-product');
    }

    public function unactiveCategoryProduct($category_product_id){
        DB::table('category_product')->where('category_id', $category_product_id)->update(['category_status' => 0]);
        Session::put('message','Bỏ kích hoạt thành công');
        return redirect('all-category-product');
    }

    public function editCategoryProduct($category_product_id){
        $edit_category_product = DB::table('category_product')->where('category_id', $category_product_id)->get();
        return view('admin.editCategoryProduct')->with('edit_category_product', $edit_category_product);
    }

    public function updateCategoryProduct(Request $request,$category_product_id){
        $data = array();
        $data['category_name'] = $request->category_product_name;
        $data['category_desc'] = $request->category_product_desc;
        DB::table('category_product')->where('category_id', $category_product_id)->update($data);
        Session::put('message','Cập nhật danh mục sản phẩm thành công');
        return redirect('all-category-product');
    }

    public function deleteCategoryProduct($category_product_id){
        DB::table('category_product')->where('category_id', $category_product_id)->delete();
        Session::put('message','Xóa danh mụcsản phẩm thành công');
        return redirect('all-category-product');
    }
}
