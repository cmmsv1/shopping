@extends('layouts.dashboard')
@section('admin')
<div class="container">
    <div class="py-4 px-4">
        <h3 class="text-center">Quản lý người dùng</h3>
        <div class="row mt-5">
            <div class="col-lg-12 mx-auto">
                <h4 class="text-center">Danh sách người dùng</h4>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <input type="text" id="search_box" class="form-control" placeholder="Search.....">
                        </div>
                    </div>
                </div>
                <div id="read" class="mt-3">
                    @include('admin.users.userdata')
                </div>
                <input type="hidden" id="page_id" value="1">
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
        
</div>
<script>
    $(document).ready(function () {
        // lấy data add vào read
        function fetch_data(page,search=''){
            $.ajax({
                url: '/admin/users/getData?page='+page+"&search="+search,
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

        // xoá user
        $(document).on('click', '.remove',function(event) {
            event.preventDefault();
            swal({
                title: "Are you sure?",
                text: "Bạn có chắc chắn muốn xoá người dùng này ? ",
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
                        url: "/admin/users/remove/" + id,
                        data: {
                        },
                        success: function (response) {
                            if(response.warning){
                                swal({
                                    title: "Waning!",
                                    text: response.warning,
                                    icon: "warning",
                                });
                            }
                            else{
                                swal({
                                    title: "Success!",
                                    text: response.message,
                                    icon: "success",
                                });
                            }
                            fetch_data();
                            $('#search_box').val('');
                        }
                    });
                }
            });
            
        });
        // show form edit user
        $(document).on('click', '.edit',function(event) {
            event.preventDefault();
            var id = $(this).data('href');
            $.get("/admin/users/edit/"+id,
                function (data) {
                    $("#formModalLabel").html('Sửa thông tin người dùng')
                    $('#formModal').modal('show');
                    $('#page').html(data)
                }
            );
        });
        // submit update user
        $("#actions").submit(function(event){
            event.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                type: "POST",
                url: "{{route('admin.users.store')}}",
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
                // error: function(e){
                //     let error = e.responseJSON.errors;
                //     for(let key in error){
                //         $('.'+ key+'_error').text(error[key][0]);
                //         $('.'+ key+'_error').parent().find('.form-control').addClass('is-invalid');
                //     }
                // }
            });
        });

});
</script>
@endsection