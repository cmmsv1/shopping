@extends('layouts.dashboard')
@section('admin')
    <div class="container">
        <div class="py-4 px-4">
            <h3 class="text-center">Quản lý sản phẩm</h3>
            <div class="row mt-3">
                <div class="col-lg-12 mx-auto">
                    <div class="success"></div>
                    <div>
                        <button type="button" style="float: right;" class="btn btn-success create">Thêm mới</button>
                    </div>
                </div>
                <div class="col-lg-12 mx-auto products">
                    <h4 class="text-center">Danh sách sản phẩm</h4>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <input type="text" id="search_product" class="form-control" placeholder="Search.....">
                            </div>
                        </div>
                    </div>
                    <div id="read">
                        @include('admin.products.read')
                    </div>
                    <input type="hidden" name="hidden_page" id="hidden_page" value="1">
                </div>

                {{-- modal --}}
                <div class="modal fade" id="formModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" style="max-width: 900px">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="formModalLabel">Modal title</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form enctype="multipart/form-data" id="actions" method="post">
                                    @csrf
                                    <div id="page" class="p-2"></div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
    </div>

    <script>     
        $(document).ready(function()
        {
            // lấy data add vào read
            function fetch_data(page,search=''){
                $.ajax({
                    url: '/admin/products/read?page='+page+"&search="+search,
                    success: function(data){
                        $('#read').html(data);
                    }
                });
            }
            // search
            $(document).on('keyup', '#search_product',function(event) { 
                var search = $("#search_product").val();
                var page = $("#hidden_page").val();
                fetch_data(page,search);
            });
            // phân trang
            $(document).on('click', '.pagination a',function(event)
            {
                event.preventDefault();
                var page=$(this).attr('href').split('page=')[1];
                var search = $(this).closest('.products').find('#search_product').val();
                fetch_data(page,search);
            });
            // save product
            $('#actions').submit(function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    type: "POST",
                    url: "{{route('admin.products.store')}}",
                    data: formData,
                    processData: false,
                    dataType: 'json',
                    contentType: false,
                    success: function (response) {
                        $('#formModal').modal('hide');
                        swal({
                            title: "Success!",
                            text: response.message,
                            icon: "success",
                        });
                        fetch_data();
                    },
                    error: function(e){
                        let error = e.responseJSON.errors;
                        for(let key in error){
                            $('.'+ key+'_error').text(error[key][0]);
                            $('.'+ key+'_error').parent().find('.form-control').addClass('is-invalid');
                        }
                    }
                });
            });
            // edit product
            $(document).on('click', '.edit',function(event) {
                event.preventDefault();
                var id = $(this).data('href');
                $.get("/admin/products/edit/"+id,
                    function (data) {
                        $("#formModalLabel").html('Sửa sản phẩm')
                        $('#formModal').modal('show');
                        $('#page').html(data);
                    }
                );
            })
            //remove product
            $(document).on('click', '.remove',function(event) {
                event.preventDefault();
                var id = $(this).data('href');
                swal({
                    title: "Are you sure?",
                    text: "Bạn có chắc chắn muốn xoá sản phẩm này ?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                    })
                    .then((willDelete) => {
                    if (willDelete) {
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            type: "DELETE",
                            url: "/admin/products/remove/" + id,
                            data: {
                            },
                            success: function (response) {
                                swal({
                                    title: "Success!",
                                    text: response.message,
                                    icon: "success",
                                });
                                fetch_data();
                            }
                        });
                    }
                });
            
            });
            // add product
            $(document).on('click', '.create',function(event) {
                $.get("/admin/products/create",
                    function (data) {
                        $("#formModalLabel").html('Thêm sản phẩm');
                        $('#formModal').modal('show');
                        $('#page').html(data)
                    }
                );
            });
    
        });
            
        

        
        
        
        
    </script>
@endsection