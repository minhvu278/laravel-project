@extends('admin_layout')
@section('content')
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">Sửa danh mục sản phẩm</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        @foreach($edit_brand as $key => $edit)
            <form class="form-horizontal" action="{{URL::to('/update-brand/'.$edit->id)}}" method="post">
                {{csrf_field()}}
                <div class="card-body">
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label"></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="name" id="inputEmail3" value="{{$edit->name}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword3" class="col-sm-2 col-form-label">Mô tả danh mục</label>
                        <div class="col-sm-10">
                            <textarea type="text" rows="8" class="form-control" name="desc" id="ckeditor">{{$edit->desc}}</textarea>
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
                    <button type="submit" class="btn btn-info">Sửa</button>
                </div>
                <!-- /.card-footer -->
            </form>
        @endforeach
    </div>
@endsection
