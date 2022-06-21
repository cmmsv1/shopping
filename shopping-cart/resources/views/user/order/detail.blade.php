@extends('layouts.dashboard')
@section('user')
<div class="container">
    <div class="py-4 px-4">
        <h3 class="text-center">Chi tiết đơn hàng</h3>
        <a href="{{route('user.orders')}}" class="btn btn-primary"><i class="ti-arrow-left"></i></a>
        <div class="row mt-5">
            <div class="col-lg-10 mx-auto">
                <div class="row">
                    <div class="col-lg-5">
                        <h4 class="text-center">Thông tin khách hàng</h4>
                        <form method="post" id="changeStatus">
                            @csrf
                            <input type="hidden" id="order_id" value="{{$order->id}}">
                            <div class="form-group">
                                <label for="">Họ và tên</label>
                                <input id="" class="form-control" type="text" value="{{$order->name}}" {{$order->status != 0?'disabled':''}}>
                            </div>
                            <div class="form-group">
                                <label for="">Số điện thoại</label>
                                <input id="" class="form-control" type="number" value="{{$order->phone}}" {{$order->status != 0?'disabled':''}}>
                            </div>
                            <div class="form-group">                          
                            <div class="form-group">
                                    <label for="">Địa chỉ:</label>
                                    <textarea id="my-textarea" class="form-control" {{$order->status != 0?'disabled':''}} rows="3">{{$order->house.','.$order->ward.','.$order->district.','.$order->province}}</textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="">Tin nhắn:</label>
                                <textarea class="form-control" id="message" {{$order->status != 0?'disabled':''}} rows="2">{{$order->message}}</textarea>
                            </div>
                            @if ($order->status != 0)
                                <span>Cảm ơn bạn đã đặt hàng</span>
                            @else
                                <button type="submit" class="btn btn-primary">Cập nhật</button>
                            @endif
                           
                        </form>
                    </div>
                    <div class="col-lg-7">
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
                        {{-- <div class="form-group" style="margin-top: 20px">
                            <label for="">Gửi tin nhắn đến người mua:</label>
                            <textarea id="my-textarea" name="message_reason" class="form-control" rows="2" placeholder="Gửi tin nhắn đến người mua ...."></textarea>
                        </div> --}}
                        @if ($order->message_reason)
                            <div class="form-group" style="margin-top: 20px">
                                <label for="">Tin nhắn của người bán:</label>
                                <textarea id="my-textarea" class="form-control"  disabled rows="2">{{$order->message_reason}}</textarea>
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
            var message = $('#message').val();
            var id = $('#order_id').val();
            $.ajax({
                type: "post",
                url: "/user/orders/update/"+id,
                data: {
                    status:status,
                    message:message
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