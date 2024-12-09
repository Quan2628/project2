<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class CategoryProductController extends Controller
{
    //Start admin
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dasboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }
    public function add_cat(){
        $this->AuthLogin();
        return view('admin.add_cat');
    }

    public function all_cat(){
        $this->AuthLogin();
        $all_category = DB::table('category_product')->get();
        $manager_cat_product = view('admin.all_cat')->with('all_category', $all_category);
        return view('master.admin_layout')->with('admin.all_cat', $manager_cat_product);
    }

    public function save_cat_product(Request $request){
        $this->AuthLogin();
        $data = array();
        $data['cat_name'] = $request->cat_product_name;
        $data['cat_description'] = $request->cat_product_description;
        $data['cat_status'] = $request->cat_product_status;

        DB::table('category_product')->insert($data);
        Session::put('message', 'Thêm sản phẩm thành công');
        return Redirect::to('add_cat');
    }

    public function unactive_cat($cat_product_id){
        $this->AuthLogin();
        DB::table('category_product')->where('cat_id', $cat_product_id)->update(['cat_status'=>1]);
        Session::put('message', 'Kích hoạt thành công');
        return Redirect::to('all_cat');
    }
    public function active_cat($cat_product_id){
        $this->AuthLogin();
        DB::table('category_product')->where('cat_id', $cat_product_id)->update(['cat_status'=>0]);
        Session::put('message', 'Kích hoạt thành công');
        return Redirect::to('all_cat');
    }

    public function edit_cat($cat_product_id){
        $this->AuthLogin();
        $edit_category = DB::table('category_product')->where('cat_id', $cat_product_id)->get();
        $manager_cat_product = view('admin.edit_cat')->with('edit_category', $edit_category);
        return view('master.admin_layout')->with('admin.update_cat', $manager_cat_product);
    }
    public function update_cat(Request $request, $cat_product_id){
        $this->AuthLogin();
        $data = array();
        $data['cat_name'] = $request->cat_product_name;
        $data['cat_description'] = $request->cat_product_description;
        DB::table('category_product')->where('cat_id', $cat_product_id)->update($data);
        Session::put('message', 'Cập nhật danh mục thành công');
        return Redirect::to('all_cat');
    }
    public function delete_cat($cat_product_id){
        $this->AuthLogin();
        DB::table('category_product')->where('cat_id', $cat_product_id)->delete();
        Session::put('message', 'Xoá danh mục thành công');
        return Redirect::to('all_cat');
    }

    //End admin

    //Start user
    public function category($cat_product_id){
        $cate_product = DB::table('category_product')->where('cat_status', '0')->orderBy('cat_id')->get();
        $brand_product = DB::table('brand_product')->where('brand_status', '0')->orderBy('brand_id')->get();
        $category_by_id = DB::table('product')->join('category_product', 'category_product.cat_id','=','product.category_id')
        ->where('product.category_id', $cat_product_id)->get();
        $category_name = DB::table('category_product')->where('category_product.cat_id', $cat_product_id)->limit(1)->get();
        return view('cate-brand.show_cate')->with('category', $cate_product)
        ->with('brand', $brand_product)->with('cate_by_id', $category_by_id)->with('category_name', $category_name);
    }
}
