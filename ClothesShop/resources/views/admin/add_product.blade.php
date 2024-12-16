@extends('master/admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Thêm mới sản phẩm
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
                        <form role="form" action="{{ route('save_product') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên sản phẩm</label>
                            <input type="text" name="product_name" class="form-control" placeholder="Điền tên sản phẩm">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Ảnh sản phẩm</label>
                            <input type="file" name="product_image" class="form-control" height="100" width="100">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả sản phẩm</label>
                            <textarea style="resize: none" rows="7" name="product_description" class="form-control" placeholder="Mô tả sản phẩm"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Giá sản phẩm</label>
                            <input type="text" name="product_price" class="form-control" placeholder="Điền giá sản phẩm">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">Danh mục sản phẩm</label>
                            <select name="cat_product" class="form-control input-sm m-bot15">
                                @foreach ($cate_product as $cat)
                                    <option value="{{$cat->cat_id}}">{{$cat->cat_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">Thương hiệu sản phẩm</label>
                            <select name="brand_product" class="form-control input-sm m-bot15">
                                @foreach ($brand_product as $brand)
                                <option value="{{$brand->brand_id}}">{{$brand->brand_name}}</option>
                            @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">Trạng thái</label>
                            <select name="product_status" class="form-control input-sm m-bot15">
                                <option value="0">Hiển thị</option>
                                <option value="1">Ẩn</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-info">Thêm sản phẩm</button>
                    </form>
                    </div>

                </div>
            </section>

    </div>
@endsection