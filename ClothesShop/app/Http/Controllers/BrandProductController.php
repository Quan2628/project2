<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class BrandProductController extends Controller
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
    public function add_brand(){
        $this->AuthLogin();
        return view('admin.add_brand');
    }

    public function all_brand(){
        $this->AuthLogin();
        $all_brand = DB::table('brand_product')->get();
        $manager_brand_product = view('admin.all_brand')->with('all_brand', $all_brand);
        return view('master.admin_layout')->with('admin.all_cat', $manager_brand_product);
    }

    public function save_brand_product(Request $request){
        $this->AuthLogin();
        $data = array();
        $data['brand_name'] = $request->brand_product_name;
        $data['brand_description'] = $request->brand_product_description;
        $data['brand_status'] = $request->brand_product_status;

        DB::table('brand_product')->insert($data);
        Session::put('message', 'Thêm thương hiệu thành công');
        return Redirect::to('add_brand');
    }

    public function unactive_brand($brand_product_id){
        $this->AuthLogin();
        DB::table('brand_product')->where('brand_id', $brand_product_id)->update(['brand_status'=>1]);
        Session::put('message', 'Kích hoạt thành công');
        return Redirect::to('all_brand');
    }
    public function active_brand($brand_product_id){
        $this->AuthLogin();
        DB::table('brand_product')->where('brand_id', $brand_product_id)->update(['brand_status'=>0]);
        Session::put('message', 'Kích hoạt thành công');
        return Redirect::to('all_brand');
    }

    public function edit_brand($brand_product_id){
        $this->AuthLogin();
        $edit_brand = DB::table('brand_product')->where('brand_id', $brand_product_id)->get();
        $manager_brand_product = view('admin.edit_brand')->with('edit_brand', $edit_brand);
        return view('master.admin_layout')->with('admin.update_brand', $manager_brand_product);
    }
    public function update_brand(Request $request, $brand_product_id){
        $this->AuthLogin();
        $data = array();
        $data['brand_name'] = $request->brand_product_name;
        $data['brand_description'] = $request->brand_product_description;
        DB::table('brand_product')->where('brand_id', $brand_product_id)->update($data);
        Session::put('message', 'Cập nhật thương hiệu thành công');
        return Redirect::to('all_brand');
    }
    public function delete_brand($brand_product_id){
        $this->AuthLogin();
        DB::table('brand_product')->where('brand_id', $brand_product_id)->delete();
        Session::put('message', 'Xoá thương hiệu thành công');
        return Redirect::to('all_brand');
    }
}
