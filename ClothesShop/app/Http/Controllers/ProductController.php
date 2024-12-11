<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
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
    public function add_product(){
        $this->AuthLogin();
        $cate_product = DB::table('category_product')->orderBy('cat_id', 'desc')->get();
        $brand_product = DB::table('brand_product')->orderBy('brand_id', 'desc')->get();
        return view('admin.add_product')->with('cate_product', $cate_product)->with('brand_product', $brand_product);
    }

    public function all_product(){
        $this->AuthLogin();
        $all_product = DB::table('product')
        ->join('category_product','category_product.cat_id','=','product.category_id')
        ->join('brand_product','brand_product.brand_id','=','product.brand_id')
        ->orderBy('product.product_id')->get();
        $manager_product = view('admin.all_product')->with('all_product', $all_product);
        return view('master.admin_layout')->with('admin.all_product', $manager_product);
    }

    public function save_product(Request $request){
        $this->AuthLogin();
        $data = array();
        $data['category_id'] = $request->cat_product;
        $data['brand_id'] = $request->brand_product;
        $data['product_name'] = $request->product_name;
        $data['product_description'] = $request->product_description;
        $data['product_price'] = $request->product_price;
        $data['product_image'] = $request->product_image;
        $data['product_status'] = $request->product_status;

        $get_image = $request->file('product_image');
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image.rand(0, 99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('uploads/product', $new_image);
            $data['product_image'] = $new_image;
            DB::table('product')->insert($data);
            Session::put('message', 'Thêm sản phẩm thành công');
            return Redirect::to('add_product');
        }
        $data['product_image'] = '';
        DB::table('product')->insert($data);
        Session::put('message', 'Thêm sản phẩm thành công');
        return Redirect::to('add_product');
    }

    public function unactive_product($product_id){
        $this->AuthLogin();
        DB::table('product')->where('product_id', $product_id)->update(['product_status'=>1]);
        Session::put('message', 'Kích hoạt thành công');
        return Redirect::to('all_product');
    }
    public function active_product($product_id){
        $this->AuthLogin();
        DB::table('product')->where('product_id', $product_id)->update(['product_status'=>0]);
        Session::put('message', 'Kích hoạt thành công');
        return Redirect::to('all_product');
    }

    public function edit_product($product_id){
        $this->AuthLogin();
        $cate_product = DB::table('category_product')->orderBy('cat_id', 'desc')->get();
        $brand_product = DB::table('brand_product')->orderBy('brand_id', 'desc')->get();
        $edit_product = DB::table('product')->where('product_id', $product_id)->get();
        $manager_product = view('admin.edit_product')->with('edit_product', $edit_product)
        ->with('cate_product', $cate_product)
        ->with('brand_product', $brand_product);
        return view('master.admin_layout')->with('admin.edit_product', $manager_product);
    }
    public function update_product(Request $request, $product_id){
        $this->AuthLogin();
        $data = array();
        $data['category_id'] = $request->cat_product;
        $data['brand_id'] = $request->brand_product;
        $data['product_name'] = $request->product_name;
        $data['product_description'] = $request->product_description;
        $data['product_price'] = $request->product_price;
        $data['product_image'] = $request->product_image;
        $data['product_status'] = $request->product_status;
        $get_image = $request->file('product_image');
        
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image.rand(0, 99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('uploads/product', $new_image);
            $data['product_image'] = $new_image;
            DB::table('product')->where('product_id', $product_id)->update($data);
            Session::put('message', 'Cập nhật sản phẩm thành công');
            return Redirect::to('all_product');
        }
        DB::table('product')->where('product_id', $product_id)->update($data);
        Session::put('message', 'Cập nhật sản phẩm thành công');
        return Redirect::to('all_product');

    }
    public function delete_product($product_id){
        $this->AuthLogin();
        DB::table('product')->where('product_id', $product_id)->delete();
        Session::put('message', 'Xoá sản phẩm thành công');
        return Redirect::to('all_product');
    }

    //End admin

    //Start user
    public function product_details($product_id){
        $cate_product = DB::table('category_product')->where('cat_status', '0')->orderBy('cat_id')->get();
        $brand_product = DB::table('brand_product')->where('brand_status', '0')->orderBy('brand_id')->get();
        $product_details = DB::table('product')
        ->join('category_product','category_product.cat_id','=','product.category_id')
        ->join('brand_product','brand_product.brand_id','=','product.brand_id')
        ->where('product.product_id', $product_id)->get();

        foreach($product_details as $pro_details){
            $category_id = $pro_details->cat_id;
        }

        $related_product = DB::table('product')
        ->join('category_product','category_product.cat_id','=','product.category_id')
        ->join('brand_product','brand_product.brand_id','=','product.brand_id')
        ->where('category_product.cat_id', $category_id)->whereNotIn('product.product_id', [$product_id])->get();

        return view('product.show_detail')->with('category', $cate_product)
        ->with('brand', $brand_product)->with('product_details', $product_details)
        ->with('related', $related_product);
    }
}
