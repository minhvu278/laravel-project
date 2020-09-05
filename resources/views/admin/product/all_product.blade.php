@extends('admin_layout')
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Liệt kê sản phẩm</h3>
                        </div>
                        <div>
                            <button type="button" class="btn btn-primary"><a
                                    href="{{URL::to('/add-product')}}">Thêm</a>
                            </button>
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
                                    <th>Tên sản phẩm</th>
                                    <th>Giá sản phẩm</th>
                                    <th>Ảnh sản phẩm</th>
                                    <th>Mô tả sản phẩm</th>
                                    <th>Hiển thị</th>
                                    <th>Hành động</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($all_product as $key => $product)
                                    <tr>
                                        <td>{{$key + 1}}</td>
                                        <td>{{$product->name}}</td>
                                        <td>{{$product->price}}</td>
                                        <td><img src="uploads/product/{{$product->image}}" width="100" height="100" alt=""></td>
                                        <td>{!! $product->desc !!}</td>
                                        <td>
                                            @if($product->status == 1)
                                                <input
                                                    toggle-display="{{$product->id}}"
                                                    type="checkbox"
                                                    name="my-checkbox"
                                                    checked
                                                    data-bootstrap-switch
                                                    data-off-color="danger"
                                                    data-on-color="success">
                                            @else
                                                <input
                                                    toggle-display="{{$product->id}}"
                                                    type="checkbox"
                                                    name="my-checkbox"
                                                    data-bootstrap-switch
                                                    data-off-color="danger"
                                                    data-on-color="success">
                                            @endif
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-warning"><a href="{{URL::to('/edit-product', $product->id)}}">Sửa</a></button>
                                            <button type="button" class="btn btn-danger"><a onclick="return confirm('Bạn có muốn xóa?')" href="{{URL::to('/delete-product', $product->id)}}">Xóa</a></button>
                                        </td>
                                    </tr>

                                @endforeach
                                </tbody>
                            </table>
                            <div class="card-footer clearfix">
                                {!! $all_product->links() !!}
                            </div>
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

@section('footer_script')
    <script src="{{asset('backend/plugins/bootstrap-switch/js/bootstrap-switch.min.js')}}"></script>
    <script>
        $("input[data-bootstrap-switch]").each(function () {
            $(this).bootstrapSwitch('state', $(this).prop('checked'));
        });

        $('input[toggle-display]').on('switchChange.bootstrapSwitch', function (event, state) {
            let id = $(this).attr('toggle-display');

            if (state === true) {
                window.location.href='/active-product/' + id
            } else {
                window.location.href='/inactive-product/' + id
            }
        })
    </script>
@endsection
