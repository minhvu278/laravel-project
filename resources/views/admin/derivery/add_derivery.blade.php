@extends('admin_layout')
@section('content')
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">Thêm thương hiệu sản phẩm</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->

        <?php
        $errorName = '';
        $errorDesc = '';

        if (isset($err)) {
            if (isset($err['name']) && count($err['name']) > 0) {
                $errorName = $err['name'][0];
            }
            if (isset($err['desc']) && count($err['desc']) > 0) {
                $errorDesc = $err['desc'][0];
            }
        }

        $name = '';
        $desc = '';
        if (isset($brand)) {
            if (isset($brand['name'])) {
                $name = $brand['name'];
            }
            if (isset($brand['desc'])) {
                $desc = $brand['desc'];
            }
        }
        ?>
        <form class="form-horizontal" action="{{URL::to('/save-brand')}}" method="post">
            {{csrf_field()}}
            <div class="card-body">
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Tên thương hiệu</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="name" value="{{$name}}" placeholder="Ten thương hiệu">
                        <p style="color: red">{{$errorName}}</p>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Mô tả thương hiệu</label>
                    <div class="col-sm-10">
                        <textarea type="text" rows="8" class="form-control" name="desc" id="ckeditor" placeholder="Mo ta thương hiệu">
                            {{$desc}}
                        </textarea>
                        <p style="color: red">{{$errorDesc}}</p>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label>Hiển thị</label>
                <div class="col-sm-10">
                    <select name="status" class="form-control">
                        <option value="0">Ẩn</option>
                        <option value="1">Hiển thị</option>
                    </select>
                </div>

            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <button type="submit" class="btn btn-info">Thêm</button>
            </div>
            <!-- /.card-footer -->
        </form>
    </div>
@endsection
