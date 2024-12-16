@extends('master/admin_layout')
@section('admin_content')
<div class="table-agile-info">
    <div class="panel panel-default">
      <div class="panel-heading">
        Thông tin khách hàng
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
              
              <th>Tên khách hàng</th>
              <th>Số điện thoại</th>

              <th style="width:30px;"></th>
            </tr>
          </thead>
          <tbody>
            
            <tr>
              <td>{{$order_by_id->cus_name}}</td>
              <td>{{$order_by_id->cus_phone}}</td>
            </tr>

          </tbody>
        </table>
      </div>
    </div>
</div>
<br>
<div class="table-agile-info">
    <div class="panel panel-default">
      <div class="panel-heading">
        Thông tin vận chuyển
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
              
                <th>Tên người vận chuyển</th>
                <th>Số điện thoại</th>
                <th>Địa chỉ</th>

            <th style="width:30px;"></th>
            </tr>
          </thead>
          <tbody>
            
            <tr>
              <td>{{$order_by_id->shipping_name}}</td>
              <td>{{$order_by_id->shipping_phone}}</td>
              <td>{{$order_by_id->shipping_address}}</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
</div>
<br>
<div class="table-agile-info">
    <div class="panel panel-default">
      <div class="panel-heading">
        Chi tiết đơn hàng
      </div>
      <div class="row w3-res-tb">
        <div class="col-sm-5 m-b-xs">             
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
              <th></th>
              <th>Tên sản phẩm</th>
              <th>Số lượng</th>
              <th>Giá</th>
              <th>Tổng tiền</th>
              <th style="width:30px;"></th>
            </tr>
          </thead>
          <tbody>
            
            <tr>
                
              <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
              <td>{{$order_by_id->product_name}}</td>
              <td>{{$order_by_id->product_sale_quantity}}</td>
              <td>{{$order_by_id->product_price}}</td>
              <td>{{$order_by_id->order_total}}</td>
              <td><span class="text-ellipsis">
              </span></td>

              <td>
                <a href="" class="active" ui-toggle-class="">
                    <i class="fa fa-pencil text-success text-active"></i>
                </a>
                <a onclick="return confirm('Bạn có muốn xoá đơn hàng này không?')" href="" class="active" ui-toggle-class="">
                    <i class="fa fa-trash text-danger text"></i>
                </a>
              </td>
            </tr>

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