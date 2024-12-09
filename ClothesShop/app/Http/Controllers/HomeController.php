<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    //
    public function index(){
        $cate_product = DB::table('category_product')->where('cat_status', '0')->orderBy('cat_id', 'desc')->get();
        $brand_product = DB::table('brand_product')->where('brand_status', '0')->orderBy('brand_id', 'desc')->get();
        $all_product = DB::table('product')->where('product_status', '0')->orderBy('product_id', 'desc')->get();
        return view('home')->with('category', $cate_product)
        ->with('brand', $brand_product)
        ->with('all_product', $all_product);
    }

}
