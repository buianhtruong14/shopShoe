<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Mail;
use App\Mail\MailNotify;

class HomeController extends Controller
{
    function index(Request $request){

        // seo
        $meta_desc = "BBT - Công ty sở hữu chuỗi trung tâm Fitness THOL Gym 5 sao, nhà phân phối thực phẩm bổ sung thể hình Mỹ độc quyền lớn nhất Việt Nam, CEO Duy Nguyễn";
        $meta_keywords = "thuc pham chuc nang, thực phẩm chức năng";
        $meta_title = "Thực phẩm bổ sung chức năng gym vip";
        $url_canonical = $request->url();

        $category_product = DB::table('category_product')->where('category_status',1)->orderby('category_id','desc')->get();
        $brand_product = DB::table('brand_product')->where('brand_status',1)->orderby('brand_id','desc')->get();
        $product = DB::table('product')->where('product_status',1)->orderby('product_id','desc')->get();
        // return view('page.index')->with('category_product', $category_product)
        //                     ->with('brand_product', $brand_product)
        //                     ->with('product', $product);
        return view('page.index')->with(compact('product','brand_product','category_product','meta_desc','meta_keywords','meta_title','url_canonical'));
        
    }

    public function search(Request $request){
        $keywords = $request->key_words;
        $category_product = DB::table('category_product')->where('category_status',1)->orderby('category_id','desc')->get();
        $brand_product = DB::table('brand_product')->where('brand_status',1)->orderby('brand_id','desc')->get();
        $search_product = DB::table('product')->where('product_status',1)
                                              ->where('product_name','like','%'.$keywords.'%')
                                              ->orderby('product_id','desc')->get();
        return view('page.search')->with('category_product', $category_product)
                            ->with('brand_product', $brand_product)
                            ->with('product', $search_product);
    }
    public function sendMail(){
        $to_name = "Anh Trường";
        $to_mail = "buianhtruong14@gmail.com";

        $data = array("name"=>"Mail từ tại khoản khách hàng","body" => 'Mai gửi về vấn đề hàng hóa');
         
        // Mail::send('admin.send_mail',$data,function($message) use ($to_name,$to_mail){
        //     $message->to($to_mail)->subject('Test thử gửi mail google');
        //     $message->from($to_mail,$to_name);
        // });
        // $email = new MailNotify();
        // Mail::to($to_mail)->send($email);
        $details = [
            'title' => 'Mail from ItSolutionStuff.com',
            'body' => 'This is for testing email using smtp'
        ];
       
        Mail::to('yyzhang1102@gmail.com')->send(new MailNotify($details));
       
        dd("Email is Sent.");

        // return redirect('/');
    }
}
