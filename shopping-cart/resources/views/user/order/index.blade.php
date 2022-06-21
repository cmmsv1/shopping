@extends('layouts.dashboard')
@section('user')
<div class="container">
    <div class="py-4 px-4">
        <h3 class="text-center">Quản lý đơn hàng</h3>
        <div class="row mt-5">
            <div class="col-lg-12 mx-auto">
                <h4 class="text-center">Danh sách đơn hàng</h4>
                <div id="read" class="mt-3">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tên khách hàng</th>
                                <th>Số điện thoại</th>
                                <th>Thành tiền</th>
                                <th>Hình thức thanh toán</th>
                                <th>Thời gian đặt hàng</th>
                                <th>Trạng thái</th>
                                <th>Chi tiết</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $item)                         
                                <tr>
                                    <td>{{$item->id}}</td>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->phone}}</td>
                                    <td>@php echo number_format($item->total, 0, ',', '.').'đ';@endphp</td>
                                    @if ($item->payment_method == 0)
                                        <td>Thanh toán khi nhận hàng</td>
                                    @else
                                        <td>{{$item->payment_method}}</td>
                                    @endif
                                    <td>{{$item->created_at}}</td>
                                    @if ($item->status == 0)
                                        <td><span style="color:#fff;padding: 10px;background-color: rgb(79,83,79)">Đơn hàng mới</span></td>
                                    @elseif ($item->status == 1)
                                        <td><span style="color:#fff;padding: 10px;background-color: rgb(56, 201, 75)">Đã được xác nhận</span></td>
                                    @elseif ($item->status == 2)
                                        <td><span style="color:#fff;padding: 10px;background-color: rgb(85, 114, 231)">Đang giao hàng</span></td>
                                    @elseif ($item->status == 3)
                                        <td><span style="color:#fff;padding: 10px;background-color: rgb(198, 226, 84)">Giao hàng thành công</span></td>
                                    @else 
                                        <td><span style="color:#fff;padding: 10px;background-color: rgb(231, 64, 81)">Đã bị huỷ bỏ</span></td>
                                    @endif
                                    <td><a href="{{route('user.orders.detail',$item->id)}}" class="btn btn-primary">Chi tiết</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <input type="hidden" id="page_id" value="1">
            </div>
        </div>
        
</div>
<script>
    $(document).ready(function () {
       // lấy data add vào read
       function fetch_data(page){
            $.ajax({
                url: 'orders/item?page='+page,
                success: function(data){
                    $('#read').html(data);
                }
            });
        }
        // phân trang ajax
        $(document).on('click', '.pagination a',function(event)
        {
            event.preventDefault();
            var page=$(this).attr('href').split('page=')[1];
            fetch_data(page);
            document.documentElement.scrollTop = 0;
        });
    });
</script>
@endsection