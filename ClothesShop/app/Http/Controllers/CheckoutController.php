<?php

namespace App\Http\Controllers;

use Darryldecode\Cart\Facades\CartFacade as Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{
    //
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dasboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }
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
        $cate_product = DB::table('category_product')->where('cat_status', '0')->orderBy('cat_id', 'desc')->get();
        $brand_product = DB::table('brand_product')->where('brand_status', '0')->orderBy('brand_id', 'desc')->get();
        return view('checkout.payment')->with('category', $cate_product)
        ->with('brand', $brand_product);
    }
    public function order(Request $request){
        //insert payment method
        $data = array();
        $data['payment_method'] = $request->payment_option;
        $data['payment_status'] = 'Đang chờ xử lí';
        $payment_id = DB::table('payment')->insertGetId($data);

        //insert order
        $order_data = array();
        $order_data['customer_id'] = Session::get('cus_id');
        $order_data['shipping_id'] = Session::get('shipping_id');
        $order_data['payment_id'] = $payment_id;
        $order_data['order_total'] = Cart::total();
        $order_data['order_status'] = 'Đang chờ xử lí';
        $order_id = DB::table('order')->insertGetId($order_data);

        //insert order_details
        $content = Cart::content();
        foreach($content as $v_content){
            $order_d_data['order_id'] = $order_id;
            $order_d_data['product_id'] = $v_content->id;
            $order_d_data['product_name'] = $v_content->name;
            $order_d_data['product_price'] = $v_content->price;
            $order_d_data['product_sale_quantity'] = $v_content->qty;
            DB::table('order_details')->insert($order_d_data);
        }
        if($data['payment_method'] == 1){
            echo 'Thanh toán ATM';
        }else{
            // Cart::destroy();
            $cate_product = DB::table('category_product')->where('cat_status', '0')->orderBy('cat_id', 'desc')->get();
            $brand_product = DB::table('brand_product')->where('brand_status', '0')->orderBy('brand_id', 'desc')->get();
            return view('checkout.cash')->with('category', $cate_product)
            ->with('brand', $brand_product);
        }

        return Redirect('payment');
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

    public function manage_order(){
        $this->AuthLogin();
        $all_order = DB::table('order')
        ->join('customer','customer.cus_id','=','order.customer_id')
        ->select('order.*', 'customer.cus_name')
        ->orderBy('order.order_id', 'desc')->get();
        $manager_order = view('admin.manage_order')->with('all_order', $all_order);
        return view('master.admin_layout')->with('admin.manage_order', $manager_order);
    }
    public function view_order($order_by_id){
        $this->AuthLogin();
        $order_by_id = DB::table('order')
        ->join('customer','customer.cus_id','=','order.customer_id')
        ->join('shipping','shipping.shipping_id','=','order.shipping_id')
        ->join('order_details','order_details.order_id','=','order.order_id')
        ->select('order.*', 'customer.*', 'shipping.*', 'order_details.*')->first();
        $manage_order_by_id = view('admin.view_order')->with('order_by_id', $order_by_id);
        return view('master.admin_layout')->with('admin.view_order', $manage_order_by_id);
    }
}
