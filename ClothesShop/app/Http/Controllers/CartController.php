<?php

namespace App\Http\Controllers;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    //
    public function save_cart(Request $request){
        $productId = $request->productid_hidden;
        $quantity = $request->quantity;
        $product_info = DB::table('product')->where('product_id', $productId)->first();

        $data['id'] = $product_info->product_id;
        $data['qty'] = $quantity;
        $data['name'] = $product_info->product_name;
        $data['price'] = $product_info->product_price;
        $data['weight'] = $product_info->product_price;
        $data['options']['image'] = $product_info->product_image;
        Cart::add($data);
        // Cart::destroy();

        return Redirect::to('show_cart');
    }

    public function show_cart(){
        $cate_product = DB::table('category_product')->where('cat_status', '0')->orderBy('cat_id', 'desc')->get();
        $brand_product = DB::table('brand_product')->where('brand_status', '0')->orderBy('brand_id', 'desc')->get();
        return view('cart.show_cart')->with('category', $cate_product)
        ->with('brand', $brand_product);
    }
    public function delete_cart($rowId){
        Cart::update($rowId, 0); // Xóa sản phẩm dựa trên rowId
        return Redirect::to('show_cart');
    }

    public function update_cart(Request $request){
        $rowId = $request->rowId_cart;
        $qty = $request->cart_quantity;
        // dd($request->id_cart, $request->cart_quantity);

        Cart::update($rowId, $qty);
        return Redirect::to('show_cart');
    }
}
