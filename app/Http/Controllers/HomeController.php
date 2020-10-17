<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;

class HomeController extends Controller
{
    function index(){
        $category_product = DB::table('category_product')->orderby('category_id','desc')->get();
        $brand_product = DB::table('brand_product')->orderby('brand_id','desc')->get();
        $product = DB::table('product')->orderby('product_id','desc')->get();
        return view('page.index')->with('category_product', $category_product)
                            ->with('brand_product', $brand_product)
                            ->with('product', $product);
        
    }
}
