@extends('master/admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Cập nhật danh mục
                </header>
                <?php
	                $message = Session::get('message');
	                if($message){
		            echo '<span style="color: green">'.$message.'</span>';
		            Session::put('message');
	                }
	            ?>
                <div class="panel-body">
                    @foreach ($edit_category as $edit_cat)
                    <div class="position-center">
                        <form role="form" action="{{ route('update_cat', ['cat_product_id' => $edit_cat->cat_id]) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên danh mục</label>
                            <input type="text" value="{{old('cat_name', $edit_cat->cat_name)}}" name="cat_product_name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả danh mục</label>
                            <textarea style="resize: none" rows="7" name="cat_product_description" class="form-control">{{ old('cat_description', $edit_cat->cat_description) }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-info">Cập nhật danh mục</button>
                    </form>
                    </div>
                    @endforeach
                </div>
            </section>
    </div>
@endsection