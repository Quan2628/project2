<?php

namespace App\Http\Controllers;

use Darryldecode\Cart\Facades\CartFacade as Cart;
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

        // $data['id'] = $product_info->product_id;
        // $data['quantity'] = $quantity;
        // $data['name'] = $product_info->product_name;
        // $data['price'] = $product_info->product_price;
        // $data['weight'] = $product_info->product_price;
        // $data['attributes']['image'] = $product_info->product_image;
        // Cart::add($data);

        Cart::add([
            'id'       => $product_info->product_id,
            'name'     => $product_info->product_name,
            'price'    => $product_info->product_price,
            'quantity' => $quantity,
            'attributes' => [
                'image' => $product_info->product_image, // Thêm đường dẫn ảnh
                'description' => $product_info->product_description
            ]
        ]);
        return Redirect::to('show_cart');
    }

    public function show_cart(){
        $cate_product = DB::table('category_product')->where('cat_status', '0')->orderBy('cat_id', 'desc')->get();
        $brand_product = DB::table('brand_product')->where('brand_status', '0')->orderBy('brand_id', 'desc')->get();
        return view('cart.show_cart')->with('category', $cate_product)
        ->with('brand', $brand_product);
    }
    public function delete_cart($rowId){
        Cart::remove($rowId); // Xóa sản phẩm dựa trên rowId
        return Redirect::to('show_cart');
    }

    public function update_cart(Request $request){
        $rowId = $request->input('id_cart');
        $qty = $request->input('cart_quantity');

        Cart::update($rowId, [
            'cart_quantity' => $qty,
        ]);
        return Redirect::to('show_cart');

    }
}
