@extends('admin_layout')
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Liệt kê mã giảm giá</h3>
                        </div>
                        <div>
                            <button type="button" class="btn btn-primary"><a
                                    href="{{URL::to('/add-coupon')}}">Thêm</a>
                            </button>
                        </div>

                    <?php
                    $message = Session::get('message');
                    if ($message) {
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
                                    <th>Tên mã</th>
                                    <th>Mã</th>
                                    <th>Số lượng mã</th>
                                    <th>Tính năng mã</th>
                                    <th>Giảm theo</th>
                                    <th>Hành động</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($coupon as $key => $cou)
                                    <tr>
                                        <td>{{$key + 1}}</td>
                                        <td>{{$cou->name}}</td>
                                        <td>{{$cou->code}}</td>
                                        <td>{{$cou->qty}}</td>
                                        <td>
                                            @if($cou->condition == 1)
                                                Giảm theo %
                                            @else
                                                Giảm theo tiền
                                            @endif
                                        </td>
                                        <td>
                                            @if($cou->condition == 1)
                                                Giảm {{$cou->number}}%
                                            @else
                                                Giảm {{$cou->number}}đ
                                            @endif
                                        </td>
                                        <td>
{{--                                            <button type="button" class="btn btn-warning"><a--}}
{{--                                                    href="{{URL::to('/edit-category', $cate->id)}}">Sửa</a></button>--}}
                                            <button type="button" class="btn btn-danger"><a
                                                    onclick="return confirm('Bạn có muốn xóa?')"
                                                    href="{{url('/delete-coupon', $cou->id)}}">Xóa</a></button>
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

{{--@section('footer_script')--}}
{{--    <script src="{{asset('backend/plugins/bootstrap-switch/js/bootstrap-switch.min.js')}}"></script>--}}
{{--    <script>--}}
{{--        $("input[data-bootstrap-switch]").each(function () {--}}
{{--            $(this).bootstrapSwitch('state', $(this).prop('checked'));--}}
{{--        });--}}

{{--        $('input[toggle-display]').on('switchChange.bootstrapSwitch', function (event, state) {--}}
{{--            let id = $(this).attr('toggle-display');--}}

{{--            if (state === true) {--}}
{{--                window.location.href='/active-category/' + id--}}
{{--            } else {--}}
{{--                window.location.href='/inactive-category/' + id--}}
{{--            }--}}
{{--        })--}}
{{--    </script>--}}
{{--@endsection--}}
