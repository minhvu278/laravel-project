@extends('admin_layout')
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Liệt kê thành viên</h3>
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
                                    <th>Tên thành viên</th>
                                    <th>Email</th>
                                    <th>Địa chỉ</th>
                                    <th>Hiển thị</th>
                                    <th>Hành động</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($all_customer as $key => $customer)
                                    <tr>
                                        <td>{{$key + 1}}</td>
                                        <td>{{$customer->name}}</td>
                                        <td>{{$customer->username}}</td>
                                        <td>{{$customer->address}}</td>
                                        <td>
                                            @if($customer->status == 1)
                                                <a href="{{URL::to('/inactive-customer/'.$customer->id)}}"><span style="color:green;font-size:28px" class="fa fa-thumbs-up"></span></a>
                                            @else
                                                <a href="{{URL::to('/active-customer/'.$customer->id)}}"><span style="color:red;font-size:28px" class="fa fa-thumbs-down"></span></a>
                                            @endif
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-warning"><a href="{{URL::to('/edit-customer', $customer->id)}}">Sửa</a></button>
                                            <button type="button" class="btn btn-danger"><a onclick="return confirm('Bạn có muốn xóa?')" href="{{URL::to('/delete-customer', $customer->id)}}">Xóa</a></button>
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
