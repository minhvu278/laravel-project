@extends('admin_layout')
@section('content')
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">Chọn khu vận chuyển </h3>
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
        <form>
            <div class="form-group">
                <label>Chọn thành phố</label>
                <div class="col-sm-10">
                    <select name="city" id="city" class="form-control choose city">
                        <option value="">---Chọn thành phố---</option>
                        @foreach($city as $ci)
                            <option value="{{$ci->matp}}">{{$ci->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label>Chọn quận huyện</label>
                <div class="col-sm-10">
                    <select name="province" id="province" class="form-control province choose ">
                        <option value="">---Chọn quận huyện---</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label>Chọn xã phường</label>
                <div class="col-sm-10">
                    <select name="wards" id="wards" class="form-control wards">
                        <option value="">---Chọn xã phường---</option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Phí vận chuyển</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control feeship" name="feeship" id="inputEmail3"
                           placeholder="Nhap phi van chuyen">
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <button type="button" name="add_delivery" class="btn btn-info add_delivery">Thêm phí vận chuyển</button>
            </div>
            <!-- /.card-footer -->
        </form>
        <div id="load_delivery">

        </div>
    </div>
    <script>
        $(document).ready(function () {
            fetch_delivery();

            function fetch_delivery() {
                $.ajax({
                    url: '/api/select-feeship',
                    method: 'POST',
                    success: function (response) {
                        let data = JSON.parse(response);
                        let html = '';
                        html += `<div class="table-responsive">
           <table class="table table-bordered">
               <thead>
                   <tr>
                       <th>Tên thành phố</th>
                       <th>Tên quận huyện</th>
                       <th>Tên xã phường</th>
                       <th>Phí ship</th>
                   </tr>
               </thead>
               <tbody>
               `;

                        for (let i = 0; i < data.length; i++) {
                            html += `
                   <tr>
                       <td>${data[i].city_name}</td>
                       <td>${data[i].province_name}</td>
                       <td>${data[i].wards_name}</td>
                       <td contenteditable data-feeship_id="${data[i].id}">${data[i].feeship}</td>
                   </tr>`;
                        }
                        html += `
               </tbody>
           </table>
         </div>`;
                        $('#load_delivery').html(html);
                    }
                })
            }


            $('.add_delivery').click(function () {
                $.ajax({
                    url: '/api/insert-delivery',
                    method: 'POST',
                    data: {
                        city: $('.city').val(),
                        province: $('.province').val(),
                        wards: $('.wards').val(),
                        feeship: $('.feeship').val()
                    },
                    success: function (data) {
                        alert('Thêm phí vận chuyển thành công');
                    },
                    fail: function (response) {
                        console.log(response)
                    }
                })

            })
            $('.choose').on('change', function () {
                var action = $(this).attr('id');
                var ma_id = $(this).val();
                var result = '';
                if (action === 'city') {
                    result = 'province';
                } else {
                    result = 'wards';
                }
                $.ajax({
                    url: '/api/select-delivery',
                    method: 'POST',
                    data: {
                        action: action,
                        ma_id: ma_id
                    },
                    success: function (data) {
                        $('#' + result).html(data);
                    }
                })
            })
        })
    </script>
@endsection
