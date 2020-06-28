@extends('admin_layout')
@section('content')
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">Sửa danh mục sản phẩm</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <?php
        $errorName = '';
        $errorUsername = '';
        $errorAddress = '';
        $errorPhone = '';

        if (isset($err)) {
            if (isset($err['name']) && count($err['name']) > 0) {
                $errorName = $err['name'][0];
            }
            if (isset($err['username']) && count($err['username']) > 0) {
                $errorDesc = $err['username'][0];
            }
            if (isset($err['address']) && count($err['address']) > 0) {
                $errorDesc = $err['address'][0];
            }
            if (isset($err['phone']) && count($err['phone']) > 0) {
                $errorDesc = $err['phone'][0];
            }
        }
        ?>
        @foreach($edit_customer as $key => $edit)
            <form class="form-horizontal" action="{{url('/update-customer/'.$edit->id)}}" method="post">
                {{csrf_field()}}
                <div class="card-body">
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Tên thành viên</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="name" id="inputEmail3" value="{{$edit->name}}">
                            <p style="color: red">{{$errorName}}</p>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword3" class="col-sm-2 col-form-label">Username</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" name="username" id="inputEmail3" value="{{$edit->username}}">
                            <p style="color: red">{{$errorUsername}}</p>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword3" class="col-sm-2 col-form-label">Địa chỉ</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="address" value="{{$edit->address}}">
                            <p style="color: red">{{$errorAddress}}</p>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword3" class="col-sm-2 col-form-label">Số điện thoại</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" name="phone" value="{{$edit->phone}}">
                            <p style="color: red">{{$errorPhone}}</p>
                        </div>
                    </div>
                </div>
{{--                <div class="form-group">--}}
{{--                    <label>Hiển thị</label>--}}
{{--                    <div class="col-sm-10">--}}
{{--                        <select name="status" class="form-control">--}}
{{--                            <option value="0">Ẩn</option>--}}
{{--                            <option value="1">Hiển thị</option>--}}
{{--                        </select>--}}
{{--                    </div>--}}

{{--                </div>--}}
                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="submit" class="btn btn-warning">Sửa</button>
                </div>
                <!-- /.card-footer -->
            </form>
        @endforeach
    </div>
@endsection
