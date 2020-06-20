@extends('layout')
@section('content')

    @foreach($details_product as $product)
        <div class="product-details"><!--product-details-->
            <div class="col-sm-5">
                <div class="view-product">
                    <img src="{{URL::to('uploads/product/'.$product->image)}}" alt=""/>
                    <h3>ZOOM</h3>
                </div>
                <div id="similar-product" class="carousel slide" data-ride="carousel">

                    <!-- Wrapper for slides -->
                    <!-- Controls -->
                    <a class="left item-control" href="#similar-product" data-slide="prev">
                        <i class="fa fa-angle-left"></i>
                    </a>
                    <a class="right item-control" href="#similar-product" data-slide="next">
                        <i class="fa fa-angle-right"></i>
                    </a>
                </div>

            </div>
            <div class="col-sm-7">
                <div class="product-information"><!--/product-information-->
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
                    <h2>{{$product->name}}</h2>
                    <p>Mã ID: {{$product->id}}</p>
                    <span>
									<span>{{number_format($product->price). 'VND'}}</span>
									<label>Quantity:</label>
									<input type="number"
                                           name="qty"
                                           min="1"
                                           value="1"/>
                                    <input type="hidden"
                                           name="product_hidden"
                                           value="{{$product->id}}"/>
									<button type="submit" class="btn btn-fefault cart add-to-cart" data-id="{{$product->id}}" name="add_to_cart">
										<i class="fa fa-shopping-cart"></i>
										Thêm giỏ hàng
									</button>
								</span>
                    <p><b>Tình trạng:</b> Còn hàng </p>
                    <p><b>Điều kiện:</b> New</p>
                    <p><b>Thương hiệu:</b> {{$product->brand_name}}</p>
                    <p><b>Danh mục:</b> {{$product->category_name}}</p>
                </div><!--/product-information-->
            </div>
        </div><!--/product-details-->
        <div class="category-tab shop-details-tab "><!--category-tab-->
            <div class="col-sm-12">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#details" data-toggle="tab">Chi tiết</a></li>
                    <li><a href="#companyprofile" data-toggle="tab">Chi tiết sản phẩm</a></li>
                    <li><a href="#reviews" data-toggle="tab">Đánh giá</a></li>
                </ul>
            </div>
            <div class="tab-content">
                <div class="tab-pane fade active in" id="details">
                    <div class="col-sm-3">
                        <p>{!! $product->desc !!}</p>
                    </div>
                </div>
                <div class="tab-pane fade" id="companyprofile">
                    <div class="col-sm-3">
                        <div class="product-image-wrapper">
                            <div class="single-products">
                                <div class="productinfo text-center">
                                    <img src="{{URL::to('frontend/images/home/gallery1.jpg')}}" alt=""/>
                                    <h2>$56</h2>
                                    <p>Easy Polo Black Edition</p>
                                    <button type="button" class="btn btn-default add-to-cart"><i
                                            class="fa fa-shopping-cart"></i>Add to cart
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade " id="reviews">
                    <div class="col-sm-12">
                        <ul>
                            <li><a href=""><i class="fa fa-user"></i>EUGEN</a></li>
                            <li><a href=""><i class="fa fa-clock-o"></i>12:41 PM</a></li>
                            <li><a href=""><i class="fa fa-calendar-o"></i>31 DEC 2014</a></li>
                        </ul>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut
                            labore et dolore magna aliqua.Ut enim ad minim veniam, quis nostrud exercitation ullamco
                            laboris
                            nisi ut aliquip ex ea commodo consequat.Duis aute irure dolor in reprehenderit in voluptate
                            velit esse cillum dolore eu fugiat nulla pariatur.</p>
                        <p><b>Write Your Review</b></p>

                        <form action="#">
										<span>
											<input type="text" placeholder="Your Name"/>
											<input type="email" placeholder="Email Address"/>
										</span>
                            <textarea name=""></textarea>
                            <b>Rating: </b> <img src="{{URL::to('frontend/images/product-details/rating.png')}}"
                                                 alt=""/>
                            <button type="button" class="btn btn-default pull-right">
                                Submit
                            </button>
                        </form>
                    </div>
                </div>

            </div>
        </div><!--/category-tab-->
    @endforeach
    <div class="recommended_items"><!--recommended_items-->
        <h2 class="title text-center">Sản phẩm gợi ý</h2>

        <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="item active">
                    @foreach($relate_product as $relate)
                        <div class="col-sm-4">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <div class="productinfo text-center">
                                        <img src="{{URL::to('uploads/product/'.$relate->image)}}" alt=""/>
                                        <h2>{{number_format($relate->price). ' '.'VND'}}</h2>
                                        <p>{{$relate->name}}</p>
                                        <a href="#" class="btn btn-default add-to-cart"><i
                                                class="fa fa-shopping-cart"></i>Add to cart</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
                <i class="fa fa-angle-left"></i>
            </a>
            <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
                <i class="fa fa-angle-right"></i>
            </a>
        </div>
    </div><!--/recommended_items-->
@endsection
