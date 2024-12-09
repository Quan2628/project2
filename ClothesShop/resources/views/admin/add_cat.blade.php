@extends('master/admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Thêm mới danh mục
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
                        <form role="form" action="{{ route('save_cat_product') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên danh mục</label>
                            <input type="text" name="cat_product_name" class="form-control" placeholder="Điền tên danh mục">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả danh mục</label>
                            <textarea style="resize: none" rows="7" name="cat_product_description" class="form-control" placeholder="Mô tả"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">Trạng thái</label>
                            <select name="cat_product_status" class="form-control input-sm m-bot15">
                                <option value="0">Hiển thị</option>
                                <option value="1">Ẩn</option>

                            </select>
                        </div>
                        <button type="submit" class="btn btn-info">Thêm danh mục</button>
                    </form>
                    </div>

                </div>
            </section>

    </div>
@endsection