@extends('master/admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Cập nhật sản phẩm
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
                        @foreach ($edit_product as $edit_prod)
                        <form role="form" action="{{ route('update_product', ['product_id' => $edit_prod->product_id]) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên sản phẩm</label>
                            <input type="text" name="product_name" class="form-control" value="{{old('product_name', $edit_prod->product_name)}}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Ảnh sản phẩm</label>
                            <input type="file" name="product_image" class="form-control">
                            <img src="uploads/product/{{$edit_prod->product_image}}" alt="" height="60" width="60">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả sản phẩm</label>
                            <textarea style="resize: none" rows="7" name="product_description" class="form-control">{{old('product_description', $edit_prod->product_description)}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Giá sản phẩm</label>
                            <input type="text" name="product_price" class="form-control" value="{{old('product_price', $edit_prod->product_price)}}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">Danh mục sản phẩm</label>
                            <select name="cat_product" class="form-control input-sm m-bot15">
                                @foreach ($cate_product as $cat)
                                @if ($cat->cat_id==$edit_prod->category_id)
                                    <option selected value="{{$cat->cat_id}}">{{$cat->cat_name}}</option>
                                @else
                                    <option value="{{$cat->cat_id}}">{{$cat->cat_name}}</option>
                                @endif    
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">Thương hiệu sản phẩm</label>
                            <select name="brand_product" class="form-control input-sm m-bot15">
                                @foreach ($brand_product as $brand)
                                @if ($brand->brand_id==$edit_prod->brand_id)
                                <option selected value="{{$brand->brand_id}}">{{$brand->brand_name}}</option>
                                @else
                                <option value="{{$brand->brand_id}}">{{$brand->brand_name}}</option>
                                @endif
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
                        <button type="submit" class="btn btn-info">Cập nhật sản phẩm</button>
                        </form>
                    @endforeach
                    </div>
                </div>
            </section>
    </div>
@endsection