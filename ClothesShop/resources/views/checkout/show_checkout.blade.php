@extends('index')
@section('content')
<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
              <li><a href="{{ route('checkout') }}">Trang chủ</a></li>
              <li class="active">Giỏ hàng</li>
            </ol>
        </div>

        <div class="register-req">
            <p>Hãy đăng ký hoặc đăng nhập để thanh toán giỏ hàng và xem lại lịch sử mua hàng</p>
        </div><!--/register-req-->

        <div class="shopper-informations">
            <div class="row">
                <div class="col-sm-10 clearfix">
                    <div class="bill-to">
                        <p>Điền thông tin</p>
                        <div class="form-one">
                            <form action="{{ route('save_checkout') }}" method="post">
                                @csrf
                                <input type="text" name="shipping_email" placeholder="Email*">
                                <input type="text" name="shipping_name" placeholder="Họ và tên*">
                                <input type="text" name="shipping_address" placeholder="Địa chỉ">
                                <input type="text" name="shipping_phone" placeholder="Số điện thoại">
                                <textarea name="shipping_note" placeholder="Ghi chú đơn hàng" rows="6"></textarea>
                                <input type="submit" value="Gửi" name="send_order"
                                class="btn btn-primary">
                            </form>
                        </div>
                    </div>
                </div>					
            </div>
        </div>

    </div>
</section> <!--/#cart_items-->
@endsection