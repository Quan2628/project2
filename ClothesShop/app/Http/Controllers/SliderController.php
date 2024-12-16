<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slider;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class SliderController extends Controller
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
    public function manage_banner(){
        $this->AuthLogin();
        $all_slide = Slider::orderBy('slider_id', 'desc')->get();
        return view('admin.slider')->with(compact('all_slide'));
    }
    public function add_banner(){
        $this->AuthLogin();
        return view('admin.add_slider');
    }
    public function insert_banner(Request $request){
        $this->AuthLogin();
        $data = $request->all();

        $get_image = $request->file('slider_image');
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image.rand(0, 99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('uploads/slider', $new_image);

            $slider = new Slider();
            $slider->slider_name = $data['slider_name'];
            $slider->slider_image = $new_image;
            $slider->slider_status = $data['slider_status'];
            $slider->slider_description = $data['slider_description'];
            $slider->save();

            Session::put('message', 'Thêm slider thành công');
            return Redirect::to('add_banner');
        }else{
            Session::put('message', 'Chưa thêm slider');
            return Redirect::to('add_banner');
        }
    }
    public function unactive_slider($slider_id){
        $this->AuthLogin();
        DB::table('slider')->where('slider_id', $slider_id)->update(['slider_status'=>1]);
        Session::put('message', 'Kích hoạt thành công');
        return Redirect::to('manage_banner');
    }
    public function active_slider($slider_id){
        $this->AuthLogin();
        DB::table('slider')->where('slider_id', $slider_id)->update(['slider_status'=>0]);
        Session::put('message', 'Kích hoạt thành công');
        return Redirect::to('manage_banner');
    }
    public function delete_slider($slider_id){
        $this->AuthLogin();
        DB::table('slider')->where('slider_id', $slider_id)->delete();
        Session::put('message', 'Xoá thành công');
        return Redirect::to('manage_banner');
    }
}
