@extends('layouts.dashboard')
@section('admin')
    <div class="container">
        <div class="py-4 px-4">
            <h3 class="text-center">Quản lý Sliders</h3>
            <div class="row mt-3">
                <div class="col-lg-9 mx-auto">
                    <div class="success"></div>
                    <div>
                        <button type="button" id="create" style="float: right;" class="btn btn-success ">Thêm mới</button>
                    </div>
                </div>
                <div class="col-lg-9 mx-auto">
                    <h4 class="text-center">Danh sách Sliders</h4>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <input type="text" id="search_box" class="form-control" placeholder="Search.....">
                            </div>
                        </div>
                    </div>
                    <div id="read">
                        @include('admin.sliders.read')
                    </div>
                </div>
                <input type="hidden" name="hidden_page" id="hidden_page" value="1">

                {{-- modal --}}
                <div class="modal fade" id="formModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="formModalLabel">Modal title</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form enctype="multipart/form-data" id="actions" >
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
        $(document).ready(function () {


            // lấy data add vào read
            function fetch_data(page,search=''){
                $.ajax({
                    url: '/admin/home-slider/read?page='+page+"&search="+search,
                    success: function(data){
                        $('#read').html(data);
                    }
                });
            }
            // search
            $(document).on('keyup', '#search_box',function(event) { 
                var search = $("#search_box").val();
                var page = $("#hidden_page").val();
                fetch_data(page,search);
            });
            // phân trang
            $(document).on('click', '.pagination a',function(event)
            {
                event.preventDefault();
                var page=$(this).attr('href').split('page=')[1];
                var search = $(this).parent().parent().parent().parent().parent().parent().parent().find('#search_box').val();
                fetch_data(page,search);
            });

            // xoá danh mục
            $(document).on('click', '.remove',function(event) {
                event.preventDefault();
                swal({
                    title: "Are you sure?",
                    text: "Bạn có chắc chắn muốn xoá slider này ? ",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                    })
                    .then((willDelete) => {
                    if (willDelete) {
                        var id = $(this).data('href');
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            type: "DELETE",
                            url: "/admin/home-slider/remove/" + id,
                            data: {
                            },
                            success: function (response) {
                                
                                swal({
                                    title: "Success!",
                                    text: response.message,
                                    icon: "success",
                                });
                                fetch_data();
                                $('#search_box').val('');
                            }
                        });
                    }
                });
                
            });
            // show form add category
            $(document).on('click', '#create',function(event) {
                event.preventDefault();
               
                $.get("/admin/home-slider/create",
                    function (data) {
                        $("#formModalLabel").html('Thêm danh mục')
                        $('#formModal').modal('show');
                        $('#page').html(data)
                    }
                );
            });
            // show form edit category
            $(document).on('click', '.edit',function(event) {
                event.preventDefault();
                var id = $(this).data('href');
                $.get("/admin/home-slider/edit/"+id,
                    function (data) {
                        $("#formModalLabel").html('Sửa danh mục')
                        $('#formModal').modal('show');
                        $('#page').html(data)
                    }
                );
            });
            // submit form add and update category
            $("#actions").submit(function(event){
                event.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    type: "POST",
                    url: "{{route('admin.sliders.store')}}",
                    data: formData,
                    processData: false,
                    dataType: 'json',
                    contentType: false,
                    success: function (response) {
                        swal({
                            title: "Success!",
                            text: response.message,
                            icon: "success",
                        });
                        $('#formModal').modal('hide');
                        fetch_data();
                    },
                    error: function(e){
                        console.log(e);
                        // let error = e.responseJSON.errors;
                        // for(let key in error){
                        //     $('.'+ key+'_error').text(error[key][0]);
                        //     $('.'+ key+'_error').parent().find('.form-control').addClass('is-invalid');
                        // }
                    }
                });
            });

        });
    
        
    </script>
@endsection