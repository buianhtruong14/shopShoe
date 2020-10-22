<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use App\Models\Login;
use App\Models\Social;
use Socialite;
session_start();

class AdminController extends Controller
{
    public function index() {
        return view('admin.login');
    }
    public function loginGoogle(){
        return Socialite::driver('google')->redirect();
    }
    public function callbackGoogle(){
        $users = Socialite::driver('google')->stateless()->user(); 
        // return $users->id;
        $authUser = $this->findOrCreateUser($users,'google');
        $account_name = Login::where('admin_id',$authUser->user)->first();
        Session::put('admin_login',$account_name->admin_name);
        Session::put('admin_id',$account_name->admin_id);
        return redirect('/add-product')->with('message', 'Đăng nhập Admin thành công');
      
       
    }
    public function findOrCreateUser($users,$provider){
        $authUser = Social::where('provider_user_id', $users->id)->first();
        if($authUser){

            return $authUser;
        }
      
        $hieu = new Social([
            'provider_user_id' => $users->id,
            'provider' => strtoupper($provider)
        ]);

        $orang = Login::where('admin_email',$users->email)->first();

            if(!$orang){
                $orang = Login::create([
                    'admin_name' => $users->name,
                    'admin_email' => $users->email,
                    'admin_password' => ''              
                ]);
            }
        $hieu->login()->associate($orang);
        $hieu->save();

        $account_name = Login::where('admin_id',$authUser->user)->first();
        Session::put('admin_login',$account_name->admin_name);
        Session::put('admin_id',$account_name->admin_id);
        return redirect('/add-product')->with('message', 'Đăng nhập Admin thành công');


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
        $login = Login::where('admin_email', $admin_email)->where('admin_password', $admin_password)->first();
        $login_count = $login->count();
        if ($login_count){
            Session::put('admin_name', $login->admin_name);
            Session::put('admin_id', $login->admin_id);
            
            return redirect('dashboard');
        } else {
            Session::put('message','Mật khẩu hoặc tài khoản bị sai. Làm ơn nhập lại!');
            return redirect('admin');
        }

        // $admin_email = $request->admin_email;
        // $admin_password = md5($request->admin_password);
        // $result = DB::table('admin')->where('admin_email', $admin_email)->where('admin_password', $admin_password)->first();
        // if ($result){
        //     Session::put('admin_name', $result->admin_name);
        //     Session::put('admin_id', $result->admin_id);
            
        //     return redirect('dashboard');
        // } else {
        //     Session::put('message','Mật khẩu hoặc tài khoản bị sai. Làm ơn nhập lại!');
        //     return redirect('admin');
        // }
        
    }

    public function logOut(){
        $this->AuthLogin();
        Session::put('admin_name', null);
        Session::put('admin_id', null);
        return redirect('admin');
    }

    public function loginFacebook(){
        // return Socialite::driver('facebook')->redirect();
        
    }
    public function lala(){
        // return Socialite::driver('facebook')->redirect();
        
    }

    public function callBackFacebook(){
        $provider = Socialite::driver('facebook')->user();
        $account = Social::where('provider','facebook')->where('provider_user_id',$provider->getId())->first();
        if($account){
            //login in vao trang quan tri  
            $account_name = Login::where('admin_id',$account->user)->first();
            Session::put('admin_login',$account_name->admin_name);
            Session::put('admin_id',$account_name->admin_id);
            return redirect('/dashboard')->with('message', 'Đăng nhập Admin thành công');
        }else{

            $hieu = new Social([
                'provider_user_id' => $provider->getId(),
                'provider' => 'facebook'
            ]);

            $orang = Login::where('admin_email',$provider->getEmail())->first();

            if(!$orang){
                $orang = Login::create([
                    'admin_name' => $provider->getName(),
                    'admin_email' => $provider->getEmail(),
                    'admin_password' => ''
                    

                ]);
            }
            $hieu->login()->associate($orang);
            $hieu->save();

            $account_name = Login::where('admin_id',$account->user)->first();

            Session::put('admin_login',$account_name->admin_name);
             Session::put('admin_id',$account_name->admin_id);
            return redirect('/dashboard')->with('message', 'Đăng nhập Admin thành công');
        } 
    }

}
