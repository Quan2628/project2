<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;


class AdminController extends Controller
{
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }
    public function index()
    {
        return view('admin.admin_login');
    }

    // Xử lý đăng nhập
    public function logon(Request $request)
    {
        // $credentials = $request->only('name', 'password');
        // if (Auth::attempt($credentials)) {
        //     return redirect()->route('dashboard');
        // } else {
        //     return redirect()->route('login')->with('err', 'Sai tài khoản hoặc mật khẩu');
        // }
        $admin_email = $request->admin_email;
        $admin_password = md5($request->admin_password);

        $result = DB::table('admin')->where('admin_email', $admin_email)->where('admin_password', $admin_password)->first();
        if($result){
            Session::put('admin_id', $result->admin_id);
            Session::put('admin_name', $result->admin_name);
            return redirect::to('dashboard');
        }else{
            Session::put('message','Sai tài khoản hoặc mật khẩu');
            return redirect::to('/');
        }
    }

    public function logout()
    {
        $this->AuthLogin();
        Session::put('admin_id', null);
        Session::put('admin_name', null);
        return Redirect::to('admin');
    }

    public function create()
    {
        return view('register');
    }

    // public function register(Request $request)
    // {
    //     $msg = "";
    //     try {
    //         $user = User::create([
    //             'name' => $request->username,
    //             'email' => $request->email,
    //             'password' => Hash::make($request->password)
    //         ]);
    //         $msg = 'Đăng ký thành công';
    //     } catch (\Throwable $th) {
    //         $msg = 'Đăng ký thất bại';
    //     }

    //     return redirect()->route('login')->with('msg', $msg);
    // }

    public function dashboard(){
        $this->AuthLogin();
        return view('admin.dashboard');
    }
}
