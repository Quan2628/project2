@extends('index')
@section('content')
<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
              <li><a href="{{ route('show_cart') }}">Trang chủ</a></li>
              <li class="active">Giỏ hàng</li>
            </ol>
        </div>
        <div class="table-responsive cart_info">
            <?php
            $content = Cart::content();
            ?>
            <table class="table table-condensed">
                <thead>
                    <tr class="cart_menu">
                        <td class="image">Hình ảnh</td>
                        <td class="description">Tên sản phẩm</td>
                        <td class="price">Giá</td>
                        <td class="quantity">Số lượng</td>
                        <td class="total">Tổng</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($content as $v_content)
                    <tr>
                        <td class="cart_product">
                            <a href=""><img src="{{ asset('uploads/product/'.$v_content->options->image) }}" height="200" width="200"></a>
                        </td>
                        <td class="cart_description">
                            <h4><a href="">{{$v_content->name}}</a></h4>
                            <p>Mã sản phẩm: {{$v_content->id}}</p>
                        </td>
                        <td class="cart_price">
                            <p>{{number_format($v_content->price).' '.'VNĐ'}}</p>
                        </td>
                        <td class="cart_quantity">
                            <div class="cart_quantity_button">
                                <form action="{{ route('update_cart') }}" method="post">
                                @csrf
                                <input class="cart_quantity_input" type="text" name="cart_quantity" value="{{$v_content->qty}}" size="2">
                                <input type="hidden" value="{{$v_content->rowId}}" name="rowId_cart"
                                class="form-control">
                                <input type="submit" value="Cập nhật" name="update_qty"
                                class="btn-btn-default btn-sm">
                                </form>
                            </div>
                        </td>
                        <td class="cart_total">
                            <p class="cart_total_price">
                                <?php
                                $subtotal = $v_content->price * $v_content->qty;
                                echo number_format($subtotal).' '.'VNĐ'; 
                                ?>
                            </p>
                        </td>
                        <td class="cart_delete">
                            <a class="cart_quantity_delete" href="{{ route('delete_cart', $v_content->rowId) }}">
                                <i class="fa fa-times"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section> <!--/#cart_items-->

<section id="do_action">
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <div class="total_area">
                    <ul>
                        <li>Tổng <span>{{Cart::subtotal(0).' '.'VNĐ'}}</span></li>
                        <li>Thuế <span>{{Cart::tax(0).' '.'VNĐ'}}</span></li>
                        <li>Phí vẩn chuyển <span>Free</span></li>
                        <li>Thành tiền <span>{{Cart::total(0).' '.'VNĐ'}}</span></li>
                    </ul>
                    <?php
								$customer_id = Session::get('cus_id');
								if($customer_id != null){
								?>
								<a class="btn btn-default check_out" href="{{ route('checkout') }}">Thanh toán</a>
								<?php
								}else{
								?>
								<a class="btn btn-default check_out" href="{{ route('login_checkout') }}">Thanh toán</a>
								<?php
								} 
								?>
                </div>
            </div>
        </div>
    </div>
</section><!--/#do_action-->

@endsection