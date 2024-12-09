@extends('master/admin_layout')
@section('admin_content')
<div class="table-agile-info">
    <div class="panel panel-default">
      <div class="panel-heading">
        Liệt kê sản phẩm
      </div>
      <div class="row w3-res-tb">
        <div class="col-sm-5 m-b-xs">
          <select class="input-sm form-control w-sm inline v-middle">
            <option value="0">Bulk action</option>
            <option value="1">Delete selected</option>
            <option value="2">Bulk edit</option>
            <option value="3">Export</option>
          </select>
          <button class="btn btn-sm btn-primary">Áp dụng</button>              
        </div>
        <div class="col-sm-4">
        </div>
        <div class="col-sm-3">
          <div class="input-group">
            <input type="text" class="input-sm form-control" placeholder="Search">
            <span class="input-group-btn">
              <button class="btn btn-sm btn-primary" type="button">Tìm kiếm</button>
            </span>
          </div>
        </div>
      </div>
      <div class="table-responsive">
        <?php
	              $message = Session::get('message');
	              if($message){
		            echo '<span style="color: green">'.$message.'</span>';
		            Session::put('message');
	              }
	            ?>
        <table class="table table-striped b-t b-light">
          <thead>
            <tr>
              <th style="width:20px;">
                <label class="i-checks m-b-none">
                  <input type="checkbox"><i></i>
                </label>
              </th>
              <th>Tên sản phẩm</th>
              <th>Hình ảnh</th>
              <th>Giá</th>
              <th>Danh mục sản phẩm</th>
              <th>Thương hiệu sản phẩm</th>
              <th>Trạng thái</th>
              <th>Ngày thêm</th>
              <th style="width:30px;"></th>
            </tr>
          </thead>
          <tbody>
            @foreach ($all_product as $prod)
            <tr>
              <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
              <td>{{$prod->product_name}}</td>
              <td><img src="uploads/product/{{$prod->product_image}}" height="60" width="60"></td>
              <td>{{$prod->product_price}}</td>
              <td>{{$prod->cat_name}}</td>
              <td>{{$prod->brand_name}}</td>
              <td><span class="text-ellipsis">
                <?php
                if ($prod->product_status == 0){
                ?>
                  <a href="{{ route('unactive_product', ['product_id' => $prod->product_id]) }}">Hiển thị</a>
                <?php  
                }else{
                ?>
                  <a href="{{ route('active_product', ['product_id' => $prod->product_id]) }}">Ẩn</a>
                <?php
                }
                ?>
              </span></td>
              <td><span class="text-ellipsis">{{$prod->created_at}}</span></td>
              <td>
                <a href="{{ route('edit_product', ['product_id' => $prod->product_id]) }}" class="active" ui-toggle-class="">
                    <i class="fa fa-pencil text-success text-active"></i>
                </a>
                <a onclick="return confirm('Bạn có muốn xoá danh mục này không?')" href="{{ route('delete_product', ['product_id' => $prod->product_id])}}" class="active" ui-toggle-class="">
                    <i class="fa fa-times text-danger text"></i>
                </a>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <footer class="panel-footer">
        <div class="row">
          
          <div class="col-sm-5 text-center">
            <small class="text-muted inline m-t-sm m-b-sm">showing 20-30 of 50 items</small>
          </div>
          <div class="col-sm-7 text-right text-center-xs">                
            <ul class="pagination pagination-sm m-t-none m-b-none">
              <li><a href=""><i class="fa fa-chevron-left"></i></a></li>
              <li><a href="">1</a></li>
              <li><a href="">2</a></li>
              <li><a href="">3</a></li>
              <li><a href="">4</a></li>
              <li><a href=""><i class="fa fa-chevron-right"></i></a></li>
            </ul>
          </div>
        </div>
      </footer>
    </div>
  </div>
@endsection