@extends('master/admin_layout')
@section('admin_content')
<div class="table-agile-info">
    <div class="panel panel-default">
      <div class="panel-heading">
        Liệt kê thương hiệu sản phẩm
      </div>
      <div class="row w3-res-tb">
        <div class="col-sm-5 m-b-xs">
          {{-- <select class="input-sm form-control w-sm inline v-middle">
            <option value="0">Bulk action</option>
            <option value="1">Delete selected</option>
            <option value="2">Bulk edit</option>
            <option value="3">Export</option>
          </select>
          <button class="btn btn-sm btn-primary">Áp dụng</button>               --}}
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
              <th>Tên thương hiệu</th>
              <th>Hiển thị</th>
              <th>Ngày thêm</th>
              <th style="width:30px;"></th>
            </tr>
          </thead>
          <tbody>
            @foreach ($all_brand as $brand_prod)
            <tr>
              <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
              <td>{{$brand_prod->brand_name}}</td>
              <td><span class="text-ellipsis">
                <?php
                if ($brand_prod->brand_status == 0){
                ?>
                  <a href="{{ route('unactive_brand', ['brand_product_id' => $brand_prod->brand_id]) }}">Hiển thị</a>
                <?php  
                }else{
                ?>
                  <a href="{{ route('active_brand', ['brand_product_id' => $brand_prod->brand_id]) }}">Ẩn</a>
                <?php
                }
                ?>
              </span></td>
              <td><span class="text-ellipsis">{{$brand_prod->created_at}}</span></td>
              <td>
                <a href="{{ route('edit_brand', ['brand_product_id' => $brand_prod->brand_id]) }}" class="active" ui-toggle-class="">
                    <i class="fa fa-pencil text-success text-active"></i>
                </a>
                <a onclick="return confirm('Bạn có muốn xoá danh mục này không?')" href="{{ route('delete_brand', ['brand_product_id' => $brand_prod->brand_id])}}" class="active" ui-toggle-class="">
                    <i class="fa fa-trash text-danger text"></i>
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