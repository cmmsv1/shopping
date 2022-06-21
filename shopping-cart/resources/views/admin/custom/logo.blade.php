@extends('layouts.dashboard')
@section('admin')   
    <div class="container">
        <div class="px-5 py-5">  
            <h3 class="text-center mb-5">Thay đổi logo</h3>    
            <form action="" method="post" id="logo">
                @csrf
                <div class="form-group">
                    <label for="">Ảnh logo:</label>
                    <input class="form-control" name="image" style="width: 400px" type="file" onChange="readURL(this);">
                    <img id="img" class="mt-3" style="width: 100px;height: 50px;display: none" alt="">
                    @if ($logo)
                        <img src="{{asset('assets/images')}}/{{$logo}}" id="oldimg" class="mt-3" style="width: 100px;height: 50px;" alt="">
                    @endif
                </div> 
                <button type="submit" class="btn btn-primary">Update</button>
            </form>             
        </div>
    </div>
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#img').show();
                    $('#img').attr('src', e.target.result);
                    $('#oldimg').hide();
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
    <script>
        $(document).ready(function () {
            $('#logo').submit(function (e) { 
                e.preventDefault();
                var data = new FormData(this);
                $.ajax({
                    type: "post",
                    url: "/admin/custom/logo/update",
                    data: data,
                    processData: false,
                    dataType: 'json',
                    contentType: false,
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