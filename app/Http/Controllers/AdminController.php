<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();

class AdminController extends Controller
{
    public function index() {
        return view('admin.login');
    }

    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return redirect('dashboard');
        } else {
            return redirect('admin')->send();
        }
    }

    public function showDashBoard(){
        $this->AuthLogin();
        return view('admin.dashboard');
    }

    public function dashBoard(Request $request){
        $admin_email = $request->admin_email;
        $admin_password = md5($request->admin_password);
        $result = DB::table('admin')->where('admin_email', $admin_email)->where('admin_password', $admin_password)->first();
        if ($result){
            Session::put('admin_name', $result->admin_name);
            Session::put('admin_id', $result->admin_id);
            
            return redirect('dashboard');
        } else {
            Session::put('message','Mật khẩu hoặc tài khoản bị sai. Làm ơn nhập lại!');
            return redirect('admin');
        }
        
    }

    public function logOut(){
        $this->AuthLogin();
        Session::put('admin_name', null);
        Session::put('admin_id', null);
        return redirect('admin');
    }
}
