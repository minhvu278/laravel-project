@extends('layout')
@section('content')
    <section id="form"><!--form-->
        <div class="register-req">
            <p>Vui lòng đăng nhập và đăng ký để thanh toán giỏ hàng và xem lại lịch sử mua hàng</p>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-sm-4 col-sm-offset-1">
                    <div class="login-form"><!--login form-->
                        <h2>Đăng nhập tài khoản của bạn</h2>
                        <form action="{{url('/login-customer')}}" method="">
                            @csrf
                            <input type="email" name="username_account" placeholder="Email" />
                            <input type="password" name="password_account" placeholder="Password" />
                            <span>
								<input type="checkbox" class="checkbox">
								Nhớ tài khoản
							</span>
                            <button type="submit" class="btn btn-default">Đăng nhập</button>
                        </form>
                    </div><!--/login form-->
                </div>
                <div class="col-sm-1">
                    <h2 class="or">Hoặc</h2>
                </div>
                <div class="col-sm-4">
                    <div class="signup-form"><!--sign up form-->
                        <h2>Đăng ký</h2>
                        <form action="{{url('/add-customer')}}" method="post">
                            @csrf
                            <input type="text" name="name" placeholder="Họ tên"/>
                            <input type="email" name="username" placeholder="Username"/>
                            <input type="password" name="password" placeholder="Password"/>
                            <input type="text" name="address" placeholder="Địa chỉ"/>
                            <input type="number" name="phone" placeholder="Số điện thoại"/>
                            <button type="submit" class="btn btn-default">Đăng ký</button>
                        </form>
                    </div><!--/sign up form-->
                </div>
            </div>
        </div>
    </section><!--/form-->
@endsection
