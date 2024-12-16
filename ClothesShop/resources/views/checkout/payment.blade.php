@extends('index')
@section('content')
<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
              <li><a href="{{ route('checkout') }}">Trang chủ</a></li>
              <li class="active">Thanh toán giỏ hàng</li>
            </ol>
        </div>

        <div class="review-payment">
            <h2>Lịch sử giỏ hàng</h2>
        </div>
        <div class="table-responsive cart_info">
            <?php
            $content = Cart::content();
            // dd($content);
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
                                {{-- <input type="submit" value="Cập nhật" name="update_qty"
                                class="btn-btn-default btn-sm"> --}}
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
        <h4 style="margin:40px 0; font-size:20px">Chọn phương thức thanh toán</h4>
        <form action="{{ route('order') }}" method="post">
            @csrf
        <div class="payment-options">
                <span>
                    <label><input name="payment_option" value="1" type="checkbox">Thanh toán bằng thẻ</label>
                </span>
                <span>
                    <label><input name="payment_option" value="2" type="checkbox">Thanh toán tiền mặt</label>
                </span>
                <input type="submit" value="Đặt hàng" name="send_order_place" class="btn btn-primary">
        </div>
        </form>
    </div>
</section> <!--/#cart_items-->
@endsection