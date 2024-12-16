@extends('master/admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Thêm Banner
                </header>
                <?php
	                $message = Session::get('message');
	                if($message){
		            echo '<span style="color: green">'.$message.'</span>';
		            Session::put('message');
	                }
	            ?>
                <div class="panel-body">
                    <div class="position-center">
                        <form role="form" action="{{ route('insert_banner') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên slider</label>
                            <input type="text" name="slider_name" class="form-control" placeholder="Điền tên slide">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Hình ảnh</label>
                            <input type="file" name="slider_image" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả</label>
                            <textarea style="resize: none" rows="7" name="slider_description" class="form-control" placeholder="Mô tả"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">Trạng thái</label>
                            <select name="slider_status" class="form-control input-sm m-bot15">
                                <option value="0">Hiển thị</option>
                                <option value="1">Ẩn</option>
                            </select>
                        </div>
                        <button type="submit" name="add_banner" class="btn btn-info">Thêm Banner</button>
                    </form>
                    </div>

                </div>
            </section>

    </div>
@endsection