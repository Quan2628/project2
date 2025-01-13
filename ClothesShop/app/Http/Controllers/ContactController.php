<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Slider;
use Illuminate\Support\Facades\DB;

class ContactController extends Controller
{
    //
    public function contact(){
        $slider = Slider::orderBy('slider_id', 'desc')->where('slider_status', '0')->take(4)->get();
        $cate_product = DB::table('category_product')->where('cat_status', '0')->orderBy('cat_id', 'desc')->get();
        $brand_product = DB::table('brand_product')->where('brand_status', '0')->orderBy('brand_id', 'desc')->get();
        return view('contact_us.contact')->with('category', $cate_product)
        ->with('brand', $brand_product)->with('slider', $slider);
    }
    public function infomation(){
        return view('infomation.add_info');
    }
}
