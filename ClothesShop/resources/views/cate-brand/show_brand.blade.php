@extends('index')
@section('content')    
    <div class="features_items">
        @foreach ($brand_name as $br_name)    
        <h2 class="title text-center">{{$br_name->brand_name}}</h2>
        @endforeach
        @foreach ($brand_by_id as $product)
        <a href="{{ route('product_details', $product->product_id) }}">
        <div class="col-sm-4">
            <div class="product-image-wrapper">
                <div class="single-products">
                        <div class="productinfo text-center">
                            <img src="{{ asset('uploads/product/'.$product->product_image) }}" height="200" width="200"/>
                            <h2>{{number_format($product->product_price).' '.'VNĐ'}}</h2>
                            <p>{{$product->product_name}}</p>
                            <a href="#" class="btn btn-default add-to-cart">
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
        </a>
        @endforeach
    </div>

@endsection
