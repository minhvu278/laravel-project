@extends('layout')
@section('content')
    <section id="cart_items">
        <div class="container">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="{{URL::to('/')}}">Trang chủ</a></li>
                    <li class="active">Giỏ hàng của bạn</li>
                </ol>
            </div>
            @if(session()->has('message'))
                <div class="alert alert-success">
                    {{session()->get('message')}}
                </div>
            @elseif(session()->has('error'))
                <div class="alert alert-danger">
                    {{session()->get('error')}}
                </div>
            @endif
            <div class="table-responsive cart_info">
                <table class="table table-condensed">
                    <form action="{{URL::to('/update-cart')}}" method="post">
                        @csrf
                    <thead>
                    <tr class="cart_menu">
                        <td class="image">Ảnh sản phẩm</td>
                        <td class="description">Tên sản phẩm</td>
                        <td class="price">Giá</td>
                        <td class="quantity">Số lượng</td>
                        <td class="total">Tổng tiền</td>
                        <td></td>
                    </tr>
                    </thead>
                    <tbody>
                    @php
                        $total = 0;
                    @endphp
                    @foreach(Session::get('cart') as $cart)
                        @php
                            $subtotal = $cart['price'] * $cart['qty'];
                            $total += $subtotal;
                        @endphp
                    <tr>
                        <td class="cart_product">
                            <img src="{{asset('uploads/product/'. $cart['image'])}}" width="90" alt="">
                        </td>
                        <td class="cart_description">
                            <h4><a href="">{{$cart['name']}}</a></h4>
                        </td>
                        <td class="cart_price">
                            <p>{{number_format($cart['price'],0,',','.').'đ'}}</p>
                        </td>
                        <td class="cart_quantity">
                            <div class="cart_quantity_button">
                                <input style="max-width: 90px"
                                       class="cart_quantity"
                                       type="number"
                                       name="cart_qty[{{$cart['session_id']}}]"
                                       min="1"
                                       value="{{$cart['qty']}}">
                            </div>
                        </td>
                        <td class="cart_total">
                            <p class="cart_total_price">
                                {{number_format($subtotal,0,',','.').'đ'}}
                            </p>
                        </td>
                        <td class="cart_delete">
                            <a class="cart_quantity_delete" href="{{url('/delete-cart/'.$cart['session_id'])}}"><i class="fa fa-times"></i></a>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                    <tr>
                        <td><input type="submit" value="Cập nhật giỏ hàng" name="update_qty" class="btn btn-default check_out"></td>
                        <td>
                            @if(Session::get('customer'))
                                <a href="{{url('/checkout')}}" class="btn btn-default check_out">Đặt hàng</a>
                            @else
                                <a href="{{url('/login-checkout')}}" class="btn btn-default check_out">Đặt hàng</a>
                            @endif
                        </td>
                    </tr>

                </form>
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
                            <li>Tổng tiền <span>{{number_format($total,0,',','.').'đ'}}</span></li>
                        </ul>
                        <ul>
                            <li>
                                <form action="{{url('/check-coupon')}}" method="post">
                                    @csrf
                                    <input type="text" class="form-control" name="coupon" placeholder="Nhap ma giam gia">
                                    <input type="submit" class="btn btn-default check-coupon" name="check_coupon" value="Tính mã giảm giá">
                                </form>
                            </li>
                        </ul>
                        <ul>
                            @if(Session::get('coupon'))
                                @foreach(Session::get('coupon') as $cou)
                                    @if($cou['condition']==1)
                                        Mã giảm: {{$cou['number']}}%
                                        <p>
                                            @php
                                                $total_coupon = ($total * $cou['number'])/100;
                                                echo '<p>Tổng giảm:'.number_format($total_coupon,0,',','.').'đ</p>'
                                            @endphp
                                        </p>
                                        <p><li>Tiền sau khi giảm: {{number_format($total-$total_coupon,0,',','.')}}đ</li></p>
                                    @else
                                        Mã giảm: {{number_format($cou['number'],0,',','.')}}đ
                                        <p>
                                            @php
                                                $total_coupon = $total - $cou['number'];
                                            @endphp
                                        </p>
                                        <p>
                                            <li>Tổng đã giảm: {{number_format($total_coupon,0,',','.')}}đ</li>
                                        </p>
                                    @endif
                                @endforeach
                            @endif

                        </ul>

                        <a class="btn btn-default update" href="{{url('/login-checkout')}}">Thanh toán</a>

                    </div>
                </div>
            </div>
        </div>
    </section><!--/#do_action-->
@endsection

