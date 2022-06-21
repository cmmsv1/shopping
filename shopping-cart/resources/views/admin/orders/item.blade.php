<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Tên khách hàng</th>
            <th>Số điện thoại</th>
            <th>Thành tiền</th>
            <th>Hình thức thanh toán</th>
            {{-- <th>ID thanh toán</th> --}}
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
                {{-- <td>{{$item->payment_id}}</td> --}}
                <td>{{$item->created_at}}</td>
                @if ($item->status == 0)
                    <td><span style="color:#fff;padding: 10px;background-color: rgb(79,83,79)">Đơn hàng mới</span></td>
                @elseif ($item->status == 1)
                    <td><span style="color:#fff;padding: 10px;background-color: rgb(56, 201, 75)">Đã được xác nhận</span></td>
                @elseif ($item->status == 2)
                    <td><span style="color:#fff;padding: 10px;background-color: rgb(85, 114, 231)">Đang giao hàng</span></td>
                @elseif ($item->status == 3)
                    <td><span style="color:#fff;padding: 10px;background-color: rgb(228, 22, 239)">Giao hàng thành công</span></td>
                @else 
                    <td><span style="color:#fff;padding: 10px;background-color: rgb(231, 64, 81)">Đã bị huỷ bỏ</span></td>
                @endif
                <td><a href="{{route('admin.orders.detail',$item->id)}}" class="btn btn-primary">Chi tiết</a></td>
            </tr>
        @endforeach
    </tbody>
</table>
{!! $orders->links()!!}