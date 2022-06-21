@extends('layouts.dashboard')
@section('admin')
<style>
    .radio input{
        margin-right: 5px
    }
    .radio label{
        font-size: 11px
    }
</style>
<div class="container">
    <div class="py-4 px-4">
        <h3 class="text-center">Chi tiết đơn hàng</h3>
        <a href="{{route('admin.orders')}}" class="btn btn-primary"><i class="ti-arrow-left"></i></a>
        <div class="row mt-5">
            <div class="col-lg-10 mx-auto">
                <div class="row">
                    <div class="col-lg-6">
                        <h4 class="text-center">Thông tin khách hàng</h4>
                        <form method="post" id="changeStatus">
                            @csrf
                            <input type="hidden" id="order_id" value="{{$order->id}}">
                            <div class="form-group">
                                <label for="">Họ và tên</label>
                                <input id="" class="form-control" type="text" value="{{$order->name}}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="">Số điện thoại</label>
                                <input id="" class="form-control" type="number" value="{{$order->phone}}" disabled>
                            </div>
                            <div class="form-group">                          
                            <div class="form-group">
                                    <label for="">Địa chỉ:</label>
                                    <textarea id="my-textarea" class="form-control" disabled rows="3">{{$order->house.','.$order->ward.','.$order->district.','.$order->province}}</textarea>
                                </div>
                            </div>
                            @if ($order->message)
                                <div class="form-group">
                                    <label for="">Tin nhắn:</label>
                                    <textarea id="my-textarea" class="form-control" disabled rows="2">{{$order->message}}</textarea>
                                </div>
                            @endif
                            
                            @if ($order->status != 4)
                                <div class="form-group">
                                    <label for="my-select">Trạng thái</label>
                                    {{-- <select id="my-select" class="form-control" name='status'>
                                        <option value="0" {{$order->status == '0'?'selected':''}}>Đơn hàng mới</option>
                                        <option value="1" {{$order->status == '1'?'selected':''}}>Xác nhận đơn</option>
                                        <option value="2" {{$order->status == '2'?'selected':''}}>Huỷ đơn</option>                           
                                    </select> --}}
                                    <div style="display: flex;gap: 0px 10px">
                                        <div class="radio">
                                            <label><input type="radio" name="status" value="0" {{$order->status == '0'?'checked':''}}>Chờ xác nhận</label>
                                        </div>
                                        <div class="radio">
                                            <label><input type="radio" name="status" value="1" {{$order->status == '1'?'checked':''}} >Xác nhận</label>
                                        </div>
                                        <div class="radio">
                                            <label><input type="radio" name="status" value="2"  {{$order->status == '2'?'checked':''}}>Đang giao hàng</label>
                                        </div>
                                        <div class="radio">
                                            <label><input type="radio" name="status" value="3"  {{$order->status == '3'?'checked':''}}>Giao hàng thành công</label>
                                        </div>
                                        <div class="radio">
                                            <label><input type="radio" name="status" value="4"  {{$order->status == '4'?'checked':''}}>Huỷ đơn</label>
                                        </div>
                                    </div>
                                
                                </div>
                                <button type="submit" class="btn btn-primary">Cập nhật</button>
                            @else 
                                <span>Đơn hàng đã bị huỷ</span>
                            @endif
                        </form>
                    </div>
                    <div class="col-lg-6">
                        <h4 class="text-center">Sản phẩm mua</h4>
                        <table class="table table-striped table-bordered mt-3">
                            <thead>
                                <tr>
                                    <td>Tên sản phẩm</td>
                                    <td>Số lượng</td>
                                    <td>Giá</td>
                                    <td>Ảnh</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order_items as $item)
                                    <tr>
                                        <td>{{$item->products->name}}</td>
                                        <td>{{$item->quantity}}</td>
                                        <td>@php echo number_format($item->products->regular_price, 0, ',', '.').'đ';@endphp</td>
                                        <td><img src="{{asset('assets/images/products')}}/{{$item->products->image}}" alt=""></td>
                                    </tr>
                                @endforeach
                                
                            </tbody>
                        </table>
                        <div style="margin-top: 20px"><span>Tổng tiền: @php echo number_format($order->total, 0, ',', '.').'đ';@endphp</span></div>
                        @if ($order->status != 4)                          
                            <div class="form-group" style="margin-top: 20px">
                                <label for="">Gửi tin nhắn đến người mua:</label>
                                <input type="text" class="form-control message_reason" value="{{$order->message_reason}}">
                            </div>
                        @endif
                    </div>
                </div>
                
            </div>
            
        </div>
        
</div>
<script>
    $(document).ready(function () {
        
        $('#changeStatus').submit(function (e) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            e.preventDefault();
            var id = $('#order_id').val();
            var message_reason = $('.message_reason').val();
            var status = $('input[type="radio"]:checked').val();
            $.ajax({
                type: "post",
                url: "/admin/orders/detail/update/"+id,
                data: {
                    status:status,
                    message_reason:message_reason
                },
                success: function (response) {
                    swal({
                        title: "Success!",
                        text: response.message,
                        icon: "success",
                    });
                }
            });
        });
        
    });
    
</script>
@endsection