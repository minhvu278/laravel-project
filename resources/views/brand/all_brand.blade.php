@extends('admin_layout')
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Liệt kê thương hiệu sản phẩm</h3>
                        </div>

                    <?php
                    $message = Session::get('message');
                    if ($message){
                        echo '<span class="text alert">' . $message . '</span>';
                        Session::put('message', null);
                    }
                    ?>
                    <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Tên thương hiệu</th>
                                    <th>Mô tả thương hiệu</th>
                                    <th>Hiển thị</th>
                                    <th>Hành động</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($all_brand as $key => $brand)
                                    <tr>
                                        <td>{{$key + 1}}</td>
                                        <td>{{$brand->name}}</td>
                                        <td>{{$brand->desc}}</td>
                                        <td>
                                            @if($brand->status == 1)
                                                <a href="{{URL::to('/inactive-brand/'.$brand->id)}}"><span style="color:red;font-size:28px" class="fa fa-thumbs-down"></span></a>
                                            @else
                                                <a href="{{URL::to('/active-brand/'.$brand->id)}}"><span style="color:green;font-size:28px" class="fa fa-thumbs-up"></span></a>
                                            @endif
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-warning"><a href="{{URL::to('/edit-brand', $brand->id)}}">Sửa</a></button>
                                            <button type="button" class="btn btn-danger"><a onclick="return confirm('Bạn có muốn xóa?')" href="{{URL::to('/delete-brand', $brand->id)}}">Xóa</a></button>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
@endsection
