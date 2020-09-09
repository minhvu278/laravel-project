@extends('layout')
@section('content')
    <div class="features_items"><!--features_items-->
        <h2 class="title text-center">Sản phẩm mới nhất</h2>
        @foreach($all_product as $product)
            <div class="col-sm-4">
                <div class="product-image-wrapper">
                    <div class="single-products">
                        <div class="productinfo text-center">
                                <input type="hidden" value="{{$product->id}}"
                                       class="cart_product_id_{{$product->id}}">
                                <input type="hidden" value="{{$product->name}}"
                                       class="cart_product_name_{{$product->id}}">
                                <input type="hidden" value="{{$product->image}}"
                                       class="cart_product_image_{{$product->id}}">
                                <input type="hidden" value="{{$product->price}}"
                                       class="cart_product_price_{{$product->id}}">
                                <input type="hidden" value="1"
                                       class="cart_product_qty_{{$product->id}}">
                                <a href="{{URL::to('/chi-tiet-san-pham/'. $product->id)}}">
                                    <img src="{{URL::to('uploads/product/'.$product->image)}}" alt=""/>
                                    <h2>{{number_format($product->price). ' '.'VND'}}</h2>
                                    <p>{{$product->name}}</p>
                                </a>
                                {{--                                <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>--}}
                                <button class="btn btn-default add-to-cart" data-id="{{$product->id}}" name="add_to_cart">Add to cart</button>
                        </div>
                    </div>
                    <div class="choose">
                        <ul class="nav nav-pills nav-justified">
                            <li><a href="#"><i class="fa fa-plus-square"></i>Yêu thích</a></li>
                            <li><a href="#"><i class="fa fa-plus-square"></i>So sánh </a></li>
                        </ul>
                    </div>
                </div>
            </div>

        @endforeach

    </div><!--features_items-->
@endsection
