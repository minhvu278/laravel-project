<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Home | CANIFA</title>
    <link href="{{asset('frontend/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/css/prettyPhoto.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/css/price-range.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/css/animate.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/css/main.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/css/responsive.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/css/sweetalert.css')}}" rel="stylesheet">
<!--[if lt IE 9]>
    <script src="{{asset('frontend/js/html5shiv.js')}}"></script>
    <script src="{{asset('frontend/js/respond.min.js')}}"></script>
    <![endif]-->
    <link rel="shortcut icon" href="{{asset('frontend/images/ico/favicon.ico')}}">
    <link rel="apple-touch-icon-precomposed" sizes="144x144"
          href="{{asset('frontend/images/ico/apple-touch-icon-144-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" sizes="114x114"
          href="{{asset('frontend/images/ico/apple-touch-icon-114-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" sizes="72x72"
          href="{{asset('frontend/images/ico/apple-touch-icon-72-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed"
          href="{{asset('frontend/images/ico/apple-touch-icon-57-precomposed.png')}}">
</head><!--/head-->

<body>
<header id="header"><!--header-->
    <div class="header_top"><!--header_top-->
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="contactinfo">
                        <ul class="nav nav-pills">
                            <li><a href="#"><i class="fa fa-phone"></i> +84961 576 449</a></li>
                            <li><a href="#"><i class="fa fa-envelope"></i> dominhvu@gmail.com</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="social-icons pull-right">
                        <ul class="nav navbar-nav">
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                            <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                            <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/header_top-->

    <div class="header-middle"><!--header-middle-->
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <div class="logo pull-left">
                        <a href="{{url('/')}}"><img style="width: 150px" src="{{asset('frontend/images/logo.png')}}" alt=""/></a>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="shop-menu pull-right">
                        <ul class="nav navbar-nav">
                            <?php
                            $customer_id = Session::get('id');
                            if ($customer_id != null){
                            ?>
                                <li><a href="{{url('/checkout')}}"><i class="fa fa-crosshairs"></i> Thanh toán</a></li>
                            <?php
                            }else{
                            ?>
                                <li><a href="{{url('/login-checkout')}}"><i class="fa fa-crosshairs"></i> Thanh toán</a>
                            <?php
                            }
                            ?>
                            <li><a href="{{URL::to('/cart')}}"><i class="fa fa-shopping-cart"></i> Giỏ hàng</a></li>
                            <?php
                            $customer_id = Session::get('id');
                            if ($customer_id != null){
                            ?>
                            <li><a href="{{url('/logout-checkout')}}"><i class="fa fa-lock"></i> Đăng xuất</a></li>
                            <?php
                            }else{
                            ?>
                            <li><a href="{{url('/login-checkout')}}"><i class="fa fa-lock"></i> Đăng nhập</a></li>
                            <?php
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/header-middle-->

</header><!--/header-->

<section id="slider"><!--slider-->
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div id="slider-carousel" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
                        <li data-target="#slider-carousel" data-slide-to="1"></li>
                        <li data-target="#slider-carousel" data-slide-to="2"></li>
                    </ol>

                    <div class="carousel-inner">
                        <div class="item active">
                            <div class="col-sm-11">
                                <img src="{{asset('frontend/images/home/banner1.jpg')}}" class="girl img-responsive"
                                     alt=""/>
                            </div>
                        </div>
                        <div class="item">
                            <div class="col-sm-11">
                                <img src="{{asset('frontend/images/home/banner2.jpg')}}" class="girl img-responsive"
                                     alt=""/>
                            </div>
                        </div>

                        <div class="item">
                            <div class="col-sm-11">
                                <img src="{{asset('frontend/images/home/banner3.jpg')}}" class="girl img-responsive"
                                     alt=""/>
                            </div>
                        </div>

                    </div>

                    <a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
                        <i class="fa fa-angle-left"></i>
                    </a>
                    <a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
                        <i class="fa fa-angle-right"></i>
                    </a>
                </div>

            </div>
        </div>
    </div>
</section><!--/slider-->

<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <div class="left-sidebar">
                    <h2>Danh mục sản phẩm</h2>
                    <div class="panel-group category-products" id="accordian"><!--category-productsr-->
                        @foreach($category as $cate)
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title"><a
                                            href="{{URL::to('/danh-muc-san-pham/'. $cate->id)}}">{{$cate->name}}</a>
                                    </h4>
                                </div>
                            </div>
                        @endforeach

                    </div><!--/category-products-->

                    <div class="brands_products"><!--brands_products-->
                        <h2>Thương hiệu sản phẩm</h2>
                        @foreach($brand as $bran)
                            <div class="brands-name">
                                <ul class="nav nav-pills nav-stacked">
                                    <li><a href="{{URL::to('/thuong-hieu-san-pham/'. $bran->id)}}">{{$bran->name}}</a>
                                    </li>
                                </ul>
                            </div>
                        @endforeach
                    </div><!--/brands_products-->

                    {{--                    <div class="price-range"><!--price-range-->--}}
                    {{--                        <h2>Price Range</h2>--}}
                    {{--                        <div class="well text-center">--}}
                    {{--                            <input type="text" class="span2" value="" data-slider-min="0" data-slider-max="600" data-slider-step="5" data-slider-value="[250,450]" id="sl2" ><br />--}}
                    {{--                            <b class="pull-left">$ 0</b> <b class="pull-right">$ 600</b>--}}
                    {{--                        </div>--}}
                    {{--                    </div><!--/price-range-->--}}


                </div>
            </div>

            <div class="col-sm-9 padding-right">
                @yield('content')
            </div>
        </div>
    </div>
</section>

<footer id="footer"><!--Footer-->
    <div class="footer-top">
        <div class="container">
            <div class="row">
                <div class="col-sm-2">
                    <div class="companyinfo">
                        <h2><span>e</span>-shopper</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit,sed do eiusmod tempor</p>
                    </div>
                </div>
                <div class="col-sm-7">
                    <div class="col-sm-3">
                        <div class="video-gallery text-center">
                            <a href="#">
                                <div class="iframe-img">
                                    <img src="{{asset('frontend/images/home/iframe1.png')}}" alt=""/>
                                </div>
                                <div class="overlay-icon">
                                    <i class="fa fa-play-circle-o"></i>
                                </div>
                            </a>
                            <p>Circle of Hands</p>
                            <h2>24 DEC 2014</h2>
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="video-gallery text-center">
                            <a href="#">
                                <div class="iframe-img">
                                    <img src="{{asset('frontend/images/home/iframe2.png')}}" alt=""/>
                                </div>
                                <div class="overlay-icon">
                                    <i class="fa fa-play-circle-o"></i>
                                </div>
                            </a>
                            <p>Circle of Hands</p>
                            <h2>24 DEC 2014</h2>
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="video-gallery text-center">
                            <a href="#">
                                <div class="iframe-img">
                                    <img src="{{asset('frontend/images/home/iframe3.png')}}" alt=""/>
                                </div>
                                <div class="overlay-icon">
                                    <i class="fa fa-play-circle-o"></i>
                                </div>
                            </a>
                            <p>Circle of Hands</p>
                            <h2>24 DEC 2014</h2>
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="video-gallery text-center">
                            <a href="#">
                                <div class="iframe-img">
                                    <img src="{{asset('frontend/images/home/iframe4.png')}}" alt=""/>
                                </div>
                                <div class="overlay-icon">
                                    <i class="fa fa-play-circle-o"></i>
                                </div>
                            </a>
                            <p>Circle of Hands</p>
                            <h2>24 DEC 2014</h2>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="address">
                        <img src="{{asset('frontend/images/home/map.png')}}" alt=""/>
                        <p>505 S Atlantic Ave Virginia Beach, VA(Virginia)</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="footer-widget">
        <div class="container">
            <div class="row">
                <div class="col-sm-2">
                    <div class="single-widget">
                        <h2>Service</h2>
                        <ul class="nav nav-pills nav-stacked">
                            <li><a href="#">Online Help</a></li>
                            <li><a href="#">Contact Us</a></li>
                            <li><a href="#">Order Status</a></li>
                            <li><a href="#">Change Location</a></li>
                            <li><a href="#">FAQ’s</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="single-widget">
                        <h2>Quock Shop</h2>
                        <ul class="nav nav-pills nav-stacked">
                            <li><a href="#">T-Shirt</a></li>
                            <li><a href="#">Mens</a></li>
                            <li><a href="#">Womens</a></li>
                            <li><a href="#">Gift Cards</a></li>
                            <li><a href="#">Shoes</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="single-widget">
                        <h2>Policies</h2>
                        <ul class="nav nav-pills nav-stacked">
                            <li><a href="#">Terms of Use</a></li>
                            <li><a href="#">Privecy Policy</a></li>
                            <li><a href="#">Refund Policy</a></li>
                            <li><a href="#">Billing System</a></li>
                            <li><a href="#">Ticket System</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="single-widget">
                        <h2>About Shopper</h2>
                        <ul class="nav nav-pills nav-stacked">
                            <li><a href="#">Company Information</a></li>
                            <li><a href="#">Careers</a></li>
                            <li><a href="#">Store Location</a></li>
                            <li><a href="#">Affillate Program</a></li>
                            <li><a href="#">Copyright</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-3 col-sm-offset-1">
                    <div class="single-widget">
                        <h2>About Shopper</h2>
                        <form action="#" class="searchform">
                            <input type="text" placeholder="Your email address"/>
                            <button type="submit" class="btn btn-default"><i class="fa fa-arrow-circle-o-right"></i>
                            </button>
                            <p>Get the most recent updates from <br/>our site and be updated your self...</p>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <p class="pull-left">Copyright © 2013 E-SHOPPER Inc. All rights reserved.</p>
                <p class="pull-right">Designed by <span><a target="_blank"
                                                           href="http://www.themeum.com">Themeum</a></span></p>
            </div>
        </div>
    </div>

</footer><!--/Footer-->


<script src="{{asset('frontend/js/jquery.js')}}"></script>
<script src="{{asset('frontend/js/bootstrap.min.js')}}"></script>
<script src="{{asset('frontend/js/jquery.scrollUp.min.js')}}"></script>
<script src="{{asset('frontend/js/price-range.js')}}"></script>
<script src="{{asset('frontend/js/jquery.prettyPhoto.js')}}"></script>
<script src="{{asset('frontend/js/main.js')}}"></script>
<script src="{{asset('frontend/js/sweetalert.min.js')}}"></script>
{{--<script type="text/javascript">--}}

{{--    $(document).ready(function(){--}}
{{--        $('.send_order').click(function(){--}}
{{--            swal({--}}
{{--                    title: "Xác nhận đơn hàng",--}}
{{--                    text: "Đơn hàng sẽ không được hoàn trả khi đặt,bạn có muốn đặt không?",--}}
{{--                    type: "warning",--}}
{{--                    showCancelButton: true,--}}
{{--                    confirmButtonClass: "btn-danger",--}}
{{--                    confirmButtonText: "Cảm ơn, Mua hàng",--}}

{{--                    cancelButtonText: "Đóng,chưa mua",--}}
{{--                    closeOnConfirm: false,--}}
{{--                    closeOnCancel: false--}}
{{--                },--}}
{{--                function(isConfirm){--}}
{{--                    if (isConfirm) {--}}
{{--                        var shipping_email = $('.shipping_email').val();--}}
{{--                        var shipping_name = $('.shipping_name').val();--}}
{{--                        var shipping_address = $('.shipping_address').val();--}}
{{--                        var shipping_phone = $('.shipping_phone').val();--}}
{{--                        var shipping_notes = $('.shipping_notes').val();--}}
{{--                        var shipping_method = $('.payment_select').val();--}}
{{--                        var order_fee = $('.order_fee').val();--}}
{{--                        var order_coupon = $('.order_coupon').val();--}}
{{--                        var _token = $('input[name="_token"]').val();--}}

{{--                        $.ajax({--}}
{{--                            url: '{{url('/confirm-order')}}',--}}
{{--                            method: 'POST',--}}
{{--                            data:{shipping_email:shipping_email,shipping_name:shipping_name,shipping_address:shipping_address,shipping_phone:shipping_phone,shipping_notes:shipping_notes,_token:_token,order_fee:order_fee,order_coupon:order_coupon,shipping_method:shipping_method},--}}
{{--                            success:function(){--}}
{{--                                swal("Đơn hàng", "Đơn hàng của bạn đã được gửi thành công", "success");--}}
{{--                            }--}}
{{--                        });--}}

{{--                        window.setTimeout(function(){--}}
{{--                            location.reload();--}}
{{--                        } ,3000);--}}

{{--                    } else {--}}
{{--                        swal("Đóng", "Đơn hàng chưa được gửi, làm ơn hoàn tất đơn hàng", "error");--}}

{{--                    }--}}

{{--                });--}}


{{--        });--}}
{{--    });--}}


{{--</script>--}}
<script>
    $(document).ready(function () {
        // $.ajaxSetup({
        //     headers: {
        //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //     }
        // });

        $('.add-to-cart').click(function () {
            var id = $(this).data('id');
            var cart_product_id = $('.cart_product_id_' + id).val();
            var cart_product_name = $('.cart_product_name_' + id).val();
            var cart_product_image = $('.cart_product_image_' + id).val();
            var cart_product_price = $('.cart_product_price_' + id).val();
            var cart_product_qty = $('.cart_product_qty_' + id).val();

            $.ajax({
                url: '{{url('/api/add-cart-ajax')}}',
                method: 'post',
                data: {
                    cart_product_id: cart_product_id,
                    cart_product_name: cart_product_name,
                    cart_product_image: cart_product_image,
                    cart_product_price: cart_product_price,
                    cart_product_qty: cart_product_qty,
                },
                success: function (data) {
                    swal({
                            title: "Đã thêm sản phẩm vào giỏ hàng",
                            text: "Bạn có thể mua hàng tiếp hoặc tới giỏ hàng để tiến hành thanh toán",
                            type: "success",
                            showCancelButton: true,
                            confirmButtonClass: "btn-success",
                            confirmButtonText: "Đi tới giỏ hàng",
                            closeOnConfirm: false
                        },
                        function () {
                            window.location.href = "{{url('/cart')}}";
                        });

                }
            })
        })
    })
</script>
<script>
    $(document).ready(function () {
        $('.choose').on('change', function () {
            var action = $(this).attr('id');
            var ma_id = $(this).val();
            var result = '';
            if (action === 'city') {
                result = 'province';
            } else {
                result = 'wards';
            }
            $.ajax({
                url: '/api/select-delivery-home',
                method: 'POST',
                data: {
                    action: action,
                    ma_id: ma_id
                },
                success: function (data) {
                    $('#' + result).html(data);
                }
            })
        })
    })
</script>
<script>
    $(document).ready(function () {
        $('.calculate_delivery').click(function (e) {
            e.preventDefault();
            var matp = $('.city').val();
            var maqh = $('.province').val();
            var xaid = $('.wards').val();
            if(matp === '' && maqh === '' && xaid === ''){
                alert('Vui lòng chọn để tính phí vận chuyển')
            }else{
                $.ajax({
                    url: '/api/calculator-fee',
                    method: 'POST',
                    data: {
                        matp: matp,
                        maqh: maqh,
                        xaid: xaid,
                    },
                    success: function () {
                        location.reload();
                    }
                })
            }
        })
    })
</script>
</body>
</html>
