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
                        <div>
                            <button type="button" class="btn btn-success"><a
                                    href="{{URL::to('/add-brand')}}">Thêm</a>
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
                                                <input
                                                    toggle-display="{{$brand->id}}"
                                                    type="checkbox"
                                                    name="my-checkbox"
                                                    checked
                                                    data-bootstrap-switch
                                                    data-off-color="danger"
                                                    data-on-color="success">
                                            @else
                                                <input
                                                    toggle-display="{{$brand->id}}"
                                                    type="checkbox"
                                                    name="my-checkbox"
                                                    data-bootstrap-switch
                                                    data-off-color="danger"
                                                    data-on-color="success">
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

@section('footer_script')
    <script src="{{asset('backend/plugins/bootstrap-switch/js/bootstrap-switch.min.js')}}"></script>
    <script>
        $("input[data-bootstrap-switch]").each(function () {
            $(this).bootstrapSwitch('state', $(this).prop('checked'));
        });

        $('input[toggle-display]').on('switchChange.bootstrapSwitch', function (event, state) {
            let id = $(this).attr('toggle-display');

            if (state === true) {
                window.location.href='/active-brand/' + id
            } else {
                window.location.href='/inactive-brand/' + id
            }
        })
    </script>
@endsection
