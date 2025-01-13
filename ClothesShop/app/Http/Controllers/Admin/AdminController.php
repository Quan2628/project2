<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
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
        return view('admin.admin_register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'admin_name' => 'required|string|max:255',
            'admin_email' => 'required|email|unique:admin',
            'admin_password' => 'required|min:6|confirmed',
            'admin_phone' => 'string|max:10'
        ]);

        // Tạo người dùng mới
        Admin::create([
            'admin_name' => $request->admin_name,
            'admin_email' => $request->admin_email,
            'admin_password' => md5($request->admin_password),
            'admin_phone' => $request->admin_phone
        ]);

        // Chuyển hướng sau khi đăng ký thành công
        return redirect()->route('admin')->with('success', 'Đăng ký thành công!');
    }

    public function dashboard(){
        $this->AuthLogin();
        return view('admin.dashboard');
    }
}
