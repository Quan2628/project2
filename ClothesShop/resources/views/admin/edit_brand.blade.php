@extends('master/admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Cập nhật thương hiệu
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
                        @foreach ($edit_brand as $edit_br)
                        <form role="form" action="{{ route('update_brand', ['brand_id'=>$edit_br->brand_id]) }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên thương hiệu</label>
                            <input type="text" value="{{old('brand_name', $edit_br->brand_name)}}" name="brand_product_name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả</label>
                            <textarea style="resize: none" rows="7" name="brand_product_description" class="form-control">{{ old('brand_description', $edit_br->brand_description) }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-info">Cập nhật thương hiệu</button>
                    </form>
                    </div>
                    @endforeach
                </div>
            </section>
    </div>
@endsection