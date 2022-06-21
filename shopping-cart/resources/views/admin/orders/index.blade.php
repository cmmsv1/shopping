@extends('layouts.dashboard')
@section('admin')
<div class="container">
    <div class="py-4 px-4">
        <h3 class="text-center">Quản lý đơn hàng</h3>
        <div class="row mt-5">
            <div class="col-lg-12 mx-auto">
                <h4 class="text-center">Danh sách đơn hàng</h4>
                <div id="read" class="mt-3">
                    @include('admin.orders.item')
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