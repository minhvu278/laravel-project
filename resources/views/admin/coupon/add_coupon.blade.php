@extends('admin_layout')
@section('content')
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">Thêm mã giảm gía</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->

        <?php
        $errorName = '';
        $errorCode = '';
        $errorQty = '';
        $errorNumber = '';

        if (isset($err)) {
            if (isset($err['name']) && count($err['name']) > 0) {
                $errorName = $err['name'][0];
            }
            if (isset($err['code']) && count($err['code']) > 0) {
                $errorCode = $err['code'][0];
            }
            if (isset($err['qty']) && count($err['qty']) > 0) {
                $errorQty = $err['qty'][0];
            }
            if (isset($err['number']) && count($err['number']) > 0) {
                $errorNumber = $err['number'][0];
            }
        }

        $name = '';
        $code = '';
        $qty = '';
        $number = '';
        if (isset($coupon)) {
            if (isset($coupon['name'])) {
                $name = $coupon['name'];
            }
            if (isset($coupon['code'])) {
                $code = $coupon['code'];
            }
            if (isset($coupon['qty'])) {
                $qty = $coupon['qty'];
            }
            if (isset($coupon['number'])) {
                $number = $coupon['number'];
            }
        }
        ?>
        <form class="form-horizontal" action="{{URL::to('/save-coupon')}}" method="post">
            @csrf
            <div class="card-body">
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Tên mã</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="name" id="inputEmail3" placeholder="Ten mã"
                               value="{{$name}}">
                        <p style="color: red">{{$errorName}}</p>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Mã</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="code" id="inputEmail3" placeholder="Mã"
                               value="{{$code}}">
                        <p style="color: red">{{$errorCode}}</p>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Số lượng mã</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" name="qty" id="inputEmail3" placeholder="Số lượng"
                               value="{{$qty}}">
                        <p style="color: red">{{$errorQty}}</p>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Tính năng mã</label>
                    <div class="col-sm-10">
                        <select name="condition" class="form-control">
                            <option value="0">---Chọn---</option>
                            <option value="1">Giảm theo %</option>
                            <option value="2">Giảm theo tiền</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Nhập % hoặc tiền giảm</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" name="number" id="inputEmail3" placeholder="Số lượng"
                               value="{{$number}}">
                        <p style="color: red">{{$errorNumber}}</p>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <button type="submit" name="add_coupon" class="btn btn-info">Thêm</button>
            </div>
            <!-- /.card-footer -->
        </form>
    </div>
@endsection
