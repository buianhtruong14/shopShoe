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
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return redirect('dashboard');
        } else {
            return redirect('admin')->send();
        }
    }
    public function addProduct(){
        $this->AuthLogin();
        $category_product = DB::table('category_product')->orderby('category_id','desc')->get();
        $brand_product = DB::table('brand_product')->orderby('brand_id','desc')->get();
        return view('admin.addProduct')->with('category_product', $category_product)->with('brand_product', $brand_product);
    }

    public function allProduct(){
        $this->AuthLogin();
        $all_product = DB::table('product')->join('category_product', 'product.category_id', '=', 'category_product.category_id')
                                            ->join('brand_product', 'product.brand_id', '=', 'brand_product.brand_id')
                                        ->orderby('product_id','desc')->get();
        return view('admin.allProduct')->with('all_product', $all_product);
    }

    public function saveProduct(Request $request){
        $this->AuthLogin();
        $data = array();
        $data['product_name'] = $request->product_name;
        $data['product_size'] = $request->product_size;
        $data['product_price'] = $request->product_price;
        $data['category_id'] = $request->category_id;
        $data['brand_id'] = $request->brand_id;
        $data['product_desc'] = $request->product_desc;
        $data['product_status'] = $request->product_status;
        $get_image = $request->file('product_image');
        // $this->p($get_name_image);
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('uploads/products/',$new_image);
            $data['product_image'] = $new_image;
            DB::table('product')->insert($data);
            Session::put('message','Thêm Sản Phẩm thành công vào danh mục');
            return redirect('add-product');
        }
        $data['product_image'] = '';
        DB::table('product')->insert($data);
        Session::put('message','Thêm Sản Phẩm thành công vào danh mục');
        return redirect('add-product');
    }

    public function activeProduct($product_id){
        $this->AuthLogin();
        DB::table('product')->where('product_id', $product_id)->update(['product_status'=> 1]);
        Session::put('message','Kích hoạt thành công');
        return redirect('all-product');
    }

    public function unactiveProduct($product_id){
        $this->AuthLogin();
        DB::table('product')->where('product_id', $product_id)->update(['product_status' => 0]);
        Session::put('message','Bỏ kích hoạt thành công');
        return redirect('all-product');
    }

    public function editProduct($product_id){
        $this->AuthLogin();
        $edit_product = DB::table('product')->where('product_id', $product_id)->get();
        $category_product = DB::table('category_product')->orderby('category_id','desc')->get();
        $brand_product = DB::table('brand_product')->orderby('brand_id','desc')->get();
        return view('admin.editProduct')->with('edit_product', $edit_product)
                                        ->with('category_product', $category_product)
                                        ->with('brand_product', $brand_product);
    }

    public function updateProduct(Request $request,$product_id){
        $this->AuthLogin();
        $data = array();
        $data['product_name'] = $request->product_name;
        $data['product_size'] = $request->product_size;
        $data['product_price'] = $request->product_price;
        $data['category_id'] = $request->category_id;
        $data['brand_id'] = $request->brand_id;
        $data['product_desc'] = $request->product_desc;
        $get_image = $request->file('product_image');
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('uploads/products/',$new_image);
            $data['product_image'] = $new_image;
            DB::table('product')->where('product_id', $product_id)->update($data);
            Session::put('message','Cập nhật sản phẩm thành công');
            return redirect('all-product');
        }
        DB::table('product')->where('product_id', $product_id)->update($data);
        Session::put('message','Cập nhật sản phẩm thành công');
        return redirect('all-product');
    }

    public function deleteProduct($product_id){
        $this->AuthLogin();
        DB::table('product')->where('product_id', $product_id)->delete();
        Session::put('message','Xóa sản phẩm thành công');
        return redirect('all-product');
    }
    public function showProductDetail($product_id){
        $product_by_id = DB::table('product')->where('product_id',$product_id)->get();
        $category_product = DB::table('category_product')->orderby('category_id','desc')->get();
        $brand_product = DB::table('brand_product')->orderby('brand_id','desc')->get();
        return view('page.show_product_detail')->with('category_product', $category_product)
                            ->with('product_by_id', $product_by_id)
                            ->with('brand_product', $brand_product);
    }
}
