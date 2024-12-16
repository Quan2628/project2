@extends('index')
@section('content')    
    <div class="features_items"><!--features_items-->
        <h2 class="title text-center">Kết quả tìm kiếm</h2>
        @foreach ($search_product as $product)
        <div class="col-sm-4">
            <div class="product-image-wrapper">
                <div class="single-products">
                        <div class="productinfo text-center">
                            <a href="{{ route('product_details', $product->product_id) }}"><img src="uploads/product/{{$product->product_image}}" height="200" width="200"/></a>
                            <h2>{{number_format($product->product_price).' '.'VNĐ'}}</h2>
                            <p>{{$product->product_name}}</p>
                            <a href="{{ route('show_cart') }}" class="btn btn-default add-to-cart">
                                <i class="fa fa-shopping-cart"></i>Thêm vào giỏ hàng</a>
                        </div>
                </div>
                <div class="choose">
                    <ul class="nav nav-pills nav-justified">
                        <li><a href="#"><i class="fa fa-plus-square"></i>Thêm vào yêu thích</a></li>
                    </ul>
                </div>
            </div>
        </div>
        @endforeach
    </div><!--features_items-->

@endsection
