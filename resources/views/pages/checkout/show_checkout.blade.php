@extends('layout')
@section('content')
    <section id="cart_items">
        <div class="container">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="{{URL::to('/')}}">Trang chủ</a></li>
                    <li class="active">Giỏ hàng của bạn</li>
                </ol>
            </div><!--/breadcrums-->
            <!--/register-req-->

            <div class="shopper-informations">
                <div class="row">
                    <div class="col-sm-12 clearfix">
                        <div class="bill-to">
                            <p>Điền thông tin gửi hàng</p>
                            <div class="form-one">
                                <form method="POST">
                                    @csrf
                                    <input type="text" name="email" class="email"
                                           placeholder="Điền email">
                                    <input type="text" name="name" class="name"
                                           placeholder="Họ và tên người gửi">
                                    <input type="text" name="address" class="address"
                                           placeholder="Địa chỉ gửi hàng">
                                    <input type="text" name="phone" class="phone"
                                           placeholder="Số điện thoại">
                                    <textarea name="notes" class="notes"
                                              placeholder="Ghi chú đơn hàng của bạn" rows="5"></textarea>

                                    @if(Session::get('fee'))
                                        <input type="hidden" name="order_fee" class="order_fee"
                                               value="{{Session::get('fee')}}">
                                    @else
                                        <input type="hidden" name="order_fee" class="order_fee" value="10000">
                                    @endif

                                    @if(Session::get('coupon'))
                                        @foreach(Session::get('coupon') as $key => $cou)
                                            <input type="hidden" name="order_coupon" class="order_coupon"
                                                   value="{{$cou['code']}}">
                                        @endforeach
                                    @else
                                        <input type="hidden" name="order_coupon" class="order_coupon" value="no">
                                    @endif


                                    <div class="">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Chọn hình thức thanh toán</label>
                                            <select name="payment_select"
                                                    class="form-control input-sm m-bot15 payment_select">
                                                <option value="0">Qua chuyển khoản</option>
                                                <option value="1">Tiền mặt</option>
                                            </select>
                                        </div>
                                    </div>
                                    <input type="button" value="Xác nhận đơn hàng" name="send_order"
                                           class="btn btn-primary btn-sm send_order">
                                </form>
                                <form>
                                    @csrf

                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Chọn thành phố</label>
                                        <select name="city" id="city" class="form-control input-sm m-bot15 choose city">

                                            <option value="">--Chọn tỉnh thành phố--</option>
                                            @foreach($city as $key => $ci)
                                                <option value="{{$ci->matp}}">{{$ci->name}}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Chọn quận huyện</label>
                                        <select name="province" id="province"
                                                class="form-control input-sm m-bot15 province choose">
                                            <option value="">--Chọn quận huyện--</option>

                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Chọn xã phường</label>
                                        <select name="wards" id="wards" class="form-control input-sm m-bot15 wards">
                                            <option value="">--Chọn xã phường--</option>
                                        </select>
                                    </div>


                                    <input type="button" value="Tính phí vận chuyển" name="calculate_order"
                                           class="btn btn-primary btn-sm calculate_delivery">


                                </form>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="review-payment">
                <h2>Review & Payment</h2>
            </div>

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
                                    <p>{{number_format($cart['price'],0,',','.')}}đ</p>
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
                                    <a class="cart_quantity_delete" href="{{url('/delete-cart/'.$cart['session_id'])}}"><i
                                            class="fa fa-times"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tr>
                            <td><input type="submit" value="Cập nhật giỏ hàng" name="update_qty"
                                       class="btn btn-default check_out"></td>
                        </tr>
                    </form>
                </table>
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
                                                <input type="text" class="form-control" name="coupon"
                                                       placeholder="Nhap ma giam gia">
                                                <input type="submit" class="btn btn-default check-coupon"
                                                       name="check_coupon" value="Tính mã giảm giá">
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
                                                        @endphp
                                                    </p>
                                                    <p>
                                                        @php
                                                            $total_after_coupon = $total-$total_coupon;
                                                        @endphp
                                                    </p>
                                                @else
                                                    Mã giảm: {{number_format($cou['number'],0,',','.')}}đ
                                                    <p>
                                                        @php
                                                            $total_coupon = $total - $cou['number'];
                                                        @endphp
                                                    </p>
                                                    <p>
                                                        @php
                                                            $total_after_coupon = $total_coupon;
                                                        @endphp
                                                    </p>
                                                @endif
                                            @endforeach
                                        @endif
                                        @if(Session::get('fee'))
                                            <li>
                                                <a class="cart_quantity_delete" href="{{url('/delete-fee')}}"><i
                                                        class="fa fa-times"></i></a>
                                                Phí vận chuyển
                                                <span>{{number_format(Session::get('fee'),0,',','.')}}đ</span>
                                            </li>
                                            <?php
                                            $total_after_fee = $total - Session::get('fee');
                                            ?>
                                        @endif
                                        <li>Tổng còn:
                                            @php
                                                if (Session::get('fee') && !Session::get('coupon')){
                                                    $total_after = $total_after_fee;
                                                    echo number_format($total_after,0,',','.').'đ';
                                                }elseif (!Session::get('fee') && Session::get('coupon')){
                                                    $total_after = $total_after_coupon;
                                                    echo number_format($total_after,0,',','.').'đ';
                                                }elseif (Session::get('fee') && Session::get('coupon')){
                                                    $total_after = $total_after_coupon;
                                                    $total_after = $total_after + Session::get('fee');
                                                    echo number_format($total_after,0,',','.').'đ';
                                                }elseif (!Session::get('fee') && !Session::get('coupon')){
                                                    $total_after = $total;
                                                    echo number_format($total_after,0,',','.').'đ';
                                                }
                                            @endphp
                                        </li>
                                    </ul>
                                    <a class="btn btn-default update" href="{{url('/login-checkout')}}">Thanh toán</a>

                                </div>
                            </div>
                        </div>
                    </div>
                </section><!--/#do_action-->
            </div>
        </div>
    </section> <!--/#cart_items-->
@endsection
