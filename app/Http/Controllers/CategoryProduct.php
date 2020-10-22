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
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return redirect('dashboard');
        } else {
            return redirect('admin')->send();
        }
    }
    public function addCategoryProduct(){
        $this->AuthLogin();
        return view('admin.addCategoryProduct');
    }

    public function allCategoryProduct(){
        $this->AuthLogin();
        $all_category_product = DB::table('category_product')->get();
        return view('admin.allCategoryProduct')->with('all_category_product', $all_category_product);
    }

    public function saveCategoryProduct(Request $request){
        $this->AuthLogin();
        $data = array();
        $data['category_name'] = $request->category_product_name;
        $data['category_desc'] = $request->category_product_desc;
        $data['category_status'] = $request->category_product_status;
        $data['meta_keywords'] = $request->meta_keywords;

        DB::table('category_product')->insert($data);
        Session::put('message','Thêm danh mục sản phẩm thành công ! ');

        return redirect('add-category-product');
    }

    public function activeCategoryProduct($category_product_id){
        $this->AuthLogin();
        DB::table('category_product')->where('category_id', $category_product_id)->update(['category_status'=> 1]);
        Session::put('message','Kích hoạt thành công');
        return redirect('all-category-product');
    }

    public function unactiveCategoryProduct($category_product_id){
        $this->AuthLogin();
        DB::table('category_product')->where('category_id', $category_product_id)->update(['category_status' => 0]);
        Session::put('message','Bỏ kích hoạt thành công');
        return redirect('all-category-product');
    }

    public function editCategoryProduct($category_product_id){
        $this->AuthLogin();
        $edit_category_product = DB::table('category_product')->where('category_id', $category_product_id)->get();
        return view('admin.editCategoryProduct')->with('edit_category_product', $edit_category_product);
    }

    public function updateCategoryProduct(Request $request,$category_product_id){
        $this->AuthLogin();
        $data = array();
        $data['category_name'] = $request->category_product_name;
        $data['category_desc'] = $request->category_product_desc;
        $data['meta_keywords'] = $request->meta_keywords;
        DB::table('category_product')->where('category_id', $category_product_id)->update($data);
        Session::put('message','Cập nhật danh mục sản phẩm thành công');
        return redirect('all-category-product');
    }

    public function deleteCategoryProduct($category_product_id){
        $this->AuthLogin();
        DB::table('category_product')->where('category_id', $category_product_id)->delete();
        Session::put('message','Xóa danh mụcsản phẩm thành công');
        return redirect('all-category-product');
    }

    // end function admin page

    public function showCategoryHome(Request $request, $category_id){
        $cate_id = DB::table('category_product')->where('category_id',$category_id)->get();
        $category_product = DB::table('category_product')->where('category_status',1)->orderby('category_id','desc')->get();
        $brand_product = DB::table('brand_product')->where('brand_status',1)->orderby('brand_id','desc')->get();
        $product = DB::table('product')->where('product_status',1)->where('category_id',$category_id)->get();

        foreach($cate_id as $val){
            $meta_desc = $val->category_desc;
            $meta_keywords = $val->meta_keywords;
            $meta_title = $val->category_name;
            $url_canonical = $request->url();
        }
        // return view('page.show_category')->with('category_product', $category_product)
        //                     ->with('cate_id', $cate_id)
        //                     ->with('brand_product', $brand_product)
        //                     ->with('product', $cate_pro);
        return view('page.show_category')->with(compact('product','cate_id','brand_product','category_product','meta_desc','meta_keywords','meta_title','url_canonical'));
      
    }
}
