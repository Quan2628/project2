<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Models\Slider;

class HomeController extends Controller
{
    //
    public function AuthLogin(){
        $customer_id = Session::get('cus_id');
        if($customer_id){
            return Redirect::to('home');
        }else{
            return Redirect::to('user')->send();
        }
    }
    public function index_user()
    {
        return view('login_index');
    }
    public function logon_user(Request $request){
        // $credentials = $request->only('name', 'password');
        // if (Auth::attempt($credentials)) {
        //     return redirect()->route('dashboard');
        // } else {
        //     return redirect()->route('login')->with('err', 'Sai tài khoản hoặc mật khẩu');
        // }
        $cus_email = $request->cus_email;
        $cus_password = md5($request->cus_password);

        $result_user = DB::table('customer')->where('cus_email', $cus_email)->where('cus_password', $cus_password)->first();
        if($result_user){
            Session::put('cus_id', $result_user->cus_id);
            Session::put('cus_name', $result_user->cus_name);
            return redirect::to('index');
        }else{
            Session::put('message','Sai tài khoản hoặc mật khẩu');
            return redirect::to('/');
        }
    }
    public function logout_user()
    {
        $this->AuthLogin();
        Session::put('cus_id', null);
        Session::put('cus_name', null);
        return Redirect::to('user');
    }
    public function register_user()
    {
        return view('register');
    }

    public function index(){
        $this->AuthLogin();
        $slider = Slider::orderBy('slider_id', 'desc')->where('slider_status', '0')->take(4)->get();
        $cate_product = DB::table('category_product')->where('cat_status', '0')->orderBy('cat_id', 'desc')->get();
        $brand_product = DB::table('brand_product')->where('brand_status', '0')->orderBy('brand_id', 'desc')->get();
        $all_product = DB::table('product')->where('product_status', '0')->orderBy('product_id', 'desc')->get();
        return view('home')->with('category', $cate_product)
        ->with('brand', $brand_product)
        ->with('all_product', $all_product)
        ->with('slider', $slider);
    }
    public function search(Request $request){
        $this->AuthLogin();
        $keywords = $request->keywords_submit;
        $cate_product = DB::table('category_product')->where('cat_status', '0')->orderBy('cat_id', 'desc')->get();
        $brand_product = DB::table('brand_product')->where('brand_status', '0')->orderBy('brand_id', 'desc')->get();

        $search_product = DB::table('product')->where('product_name', 'like', '%'.$keywords.'%')->get();
        return view('product.search')->with('category', $cate_product)
        ->with('brand', $brand_product)->with('search_product', $search_product);
    }

}
