@extends('admin_layout')
@section('content')
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">Sửa sản phẩm</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <?php
        $errorName = '';
        $errorPrice = '';
        $errorDesc = '';
        $errorImage = '';

        if (isset($err)) {
            if (isset($err['name']) && count($err['name']) > 0) {
                $errorName = $err['name'][0];
            }
            if (isset($err['price']) && count($err['price']) > 0) {
                $errorPrice = $err['price'][0];
            }
            if (isset($err['desc']) && count($err['desc']) > 0) {
                $errorDesc = $err['desc'][0];
            }
            if (isset($err['image']) && count($err['image']) > 0) {
                $errorImage = $err['image'][0];
            }
        }
        ?>
        @foreach($edit_product as $pro)
        <form class="form-horizontal" action="{{URL::to('/update-product/'.$pro->id)}}" method="post" enctype="multipart/form-data">
            {{csrf_field()}}
            <div class="card-body">
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Tên sản phẩm</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="name"  value="{{($pro->name)}}">
                        <p style="color: red">{{$errorName}}</p>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Giá sản phẩm</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" name="price" value="{{($pro->price)}}">
                        <p style="color: red">{{$errorPrice}}</p>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Mô tả sản phẩm</label>
                    <div class="col-sm-10">
                        <textarea type="text" rows="8" class="form-control" name="desc" id="ckeditor">{{($pro->desc)}}</textarea>
                        <p style="color: red">{{$errorDesc}}</p>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Ảnh sản phẩm</label>
                    <div class="col-sm-3">
                        <input type="file" class="form-control" name="image" accept="image/*">
                        <img width="100px" src="{{URL::to('uploads/product/'.$pro->image)}}" alt="">
                        <p style="color: red">{{$errorImage}}</p>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label>Danh mục sản phẩm</label>
                <div class="col-sm-10">
                    <select name="product_cate" class="form-control">
                        @foreach($cate_product as $cate)
                            @if($cate->id==$pro->category_id)
                            <option selected value="{{($cate->id)}}">{{($cate->name)}}</option>
                            @else
                                <option value="{{($cate->id)}}">{{($cate->name)}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>

            </div>
            <div class="form-group">
                <label>Thương hiệu sản phẩm</label>
                <div class="col-sm-10">
                    <select name="product_brand" class="form-control">
                        @foreach($brand_product as $brand)
                            @if($brand->id==$pro->brand_id)
                            <option selected value="{{($brand->id)}}"> {{($brand->name)}} </option>
                            @else
                                <option value="{{($brand->id)}}">{{($brand->name)}}</option>
                            @endif
                        @endforeach
                    </select>
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
                <button type="submit" class="btn btn-warning">Sửa</button>
            </div>
            <!-- /.card-footer -->
        </form>
        @endforeach
    </div>
@endsection

@section('footer_script')
    <script src="{{asset('backend/ckeditor/ckeditor.js')}}"></script>
    <script>
        CKEDITOR.replace('ckeditor');
    </script>
@endsection
