<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    //
    public function save_cart(Request $request){
        $cate_product = DB::table('category_product')->where('cat_status', '0')->orderBy('cat_id', 'desc')->get();
        $brand_product = DB::table('brand_product')->where('brand_status', '0')->orderBy('brand_id', 'desc')->get();
        $productId = $request->productid_hidden;
        $quantity = $request->quantity;

        $product_info = DB::table('product')->where('product_id', $productId)->first();
        return view('cart.show_cart')->with('category', $cate_product)
        ->with('brand', $brand_product);
    }
}
