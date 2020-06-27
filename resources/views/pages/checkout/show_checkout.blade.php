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
                    <div class="col-sm-10 clearfix">
                        <div class="bill-to">
                            <p>Đơn hàng</p>
                            <div class="form-one">
                                <form action="{{url('/mail')}}" method="post">
                                    @csrf
                                    <input type="text"
                                           name="name"
                                           placeholder="Tên khách hàng">
                                    <input type="text"
                                           name="email"
                                           placeholder="Email">
                                    <input type="text"
                                           name="phone"
                                           placeholder="Số điện thoại">
                                    <input type="text"
                                           name="address"
                                           placeholder="Địa chỉ">
                                    <textarea name="notes"
                                              placeholder="Ghi chú về đơn hàng của bạn"
                                              rows="16">
                                    </textarea>
                                    <button type="submit" class="btn btn-default check_out">Gửi</button>
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

            </div>
        </div>
    </section> <!--/#cart_items-->
@endsection
