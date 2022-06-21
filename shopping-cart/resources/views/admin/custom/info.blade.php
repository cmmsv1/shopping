@extends('layouts.dashboard')
@section('admin')
    <div class="container">
        <div class="py-4 px-4">
            <h3 class="text-center">Information</h3>
            <div class="row mt-5">
                <div class="col-lg-10 mx-auto">
                    @if (!empty($info))
                        <form action="" method="post" id="info">
                            @csrf
                            <div class="form-group">
                                <label for="">Address</label>
                                <input type="text" class="form-control" value="{{ $info->address }}" name="address"
                                    placeholder="Nhập địa chỉ...">

                            </div>
                            <div class="form-group">
                                <label for="">Phone 1:</label>
                                <input type="number" class="form-control" value="{{ $info->phone1 }}" name="phone1"
                                    placeholder="Nhập phone....">
                            </div>
                            <div class="form-group">
                                <label for="">Phone 2:</label>
                                <input type="number" class="form-control" value="{{ $info->phone2 }}" name="phone2"
                                    placeholder="Nhập phone....">
                            </div>
                            <button type="submit" class="btn btn-primary">Cập nhật</button>
                        </form>
                    @else
                        <form action="" method="post" id="info">
                            @csrf
                            <div class="form-group">
                                <label for="">Address</label>
                                <input type="text" class="form-control" value="" name="address"
                                    placeholder="Nhập địa chỉ....">

                            </div>
                            <div class="form-group">
                                <label for="">Phone 1:</label>
                                <input type="number" class="form-control" value="" name="phone1"
                                    placeholder="Nhập phone...">
                            </div>
                            <div class="form-group">
                                <label for="">Phone 2:</label>
                                <input type="number" class="form-control" value="" name="phone2"
                                    placeholder="Nhập phone....">
                            </div>
                            <button type="submit" class="btn btn-primary">Cập nhật</button>
                        </form>
                    @endif

                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#info').submit(function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    type: "post",
                    url: "/admin/custom/info/update",
                    data: formData,
                    processData: false,
                    dataType: 'json',
                    contentType: false,
                    success: function(response) {
                        swal({
                            title: "Success!",
                            text: response.message,
                            icon: "success",
                        })
                    }
                });
            });
        });
    </script>
@endsection
