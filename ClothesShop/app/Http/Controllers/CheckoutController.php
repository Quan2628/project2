<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{
    //
    public function login_checkout(){
        $cate_product = DB::table('category_product')->where('cat_status', '0')->orderBy('cat_id', 'desc')->get();
        $brand_product = DB::table('brand_product')->where('brand_status', '0')->orderBy('brand_id', 'desc')->get();
        return view('checkout.login_checkout')->with('category', $cate_product)
        ->with('brand', $brand_product);
    }
    public function add_customer(Request $request){
        $data = array();
        $data['cus_name'] = $request->cus_name;
        $data['cus_email'] = $request->cus_email;
        $data['cus_password'] = md5($request->cus_password);
        $data['cus_phone'] = $request->cus_phone;

        $customer_id = DB::table('customer')->insertGetId($data);

        Session::put('cus_id', $customer_id);
        Session::put('cus_name', $request->cus_name);
        return Redirect('checkout');
    }
    public function checkout(){
        $cate_product = DB::table('category_product')->where('cat_status', '0')->orderBy('cat_id', 'desc')->get();
        $brand_product = DB::table('brand_product')->where('brand_status', '0')->orderBy('brand_id', 'desc')->get();
        return view('checkout.show_checkout')->with('category', $cate_product)
        ->with('brand', $brand_product);
    }
    public function save_checkout(Request $request){
        $data = array();
        $data['shipping_name'] = $request->shipping_name;
        $data['shipping_address'] = $request->shipping_address;
        $data['shipping_email'] = $request->shipping_email;
        $data['shipping_phone'] = $request->shipping_phone;
        $data['shipping_note'] = $request->shipping_note;

        $shipping_id = DB::table('shipping')->insertGetId($data);

        Session::put('shipping_id', $shipping_id);
        return Redirect('payment');
    }
    public function payment(){

    }
    public function logout_checkout(){
        Session::flush();
        return Redirect('login_checkout');
    }
    public function login_customer(Request $request){
        $email = $request->email_account;
        $password = md5($request->password_account);
        $result = DB::table('customer')->where('cus_email', $email)->where('cus_password', $password)->first();
        
        Session::put('cus_id', $result->cus_id);
        return Redirect('checkout');
    }
}
