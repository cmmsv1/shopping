@extends('layouts.dashboard')
@section('content')
    <div class="container">
        <div class="px-5 py-5">
            <h3 class="text-center">Infomation</h3>
            @if (!empty($address))
                <form method="post" id="info">
                    @csrf
                    <div class="form-group">
                        <label for="province">Tỉnh/Thành phố:*</label>
                        <input id="province" class="form-control" type="text" name="province"
                            value="{{ $address->province }}" placeholder="Nhập Tỉnh/Thành phố ...">
                        <span style="color: red;font-size: 13px; padding:5px 10px;" class="err province_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="district">Quận/Huyện:<span>*</span></label>
                        <input id="district" class="form-control" type="text" name="district"
                            value="{{ $address->district }}" placeholder="Nhập Quận/Huyện... ">
                        <span style="color: red;font-size: 13px; padding:5px 10px;" class="err district_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="ward">Phường/Xã:*</label>
                        <input id="ward" class="form-control" type="text" name="ward"
                            value="{{ $address->ward }}" placeholder="Nhập Phường/Xã...">
                        <span style="color: red;font-size: 13px; padding:5px 10px;" class="err ward_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="house">Tên đường/Toà nhà/Số nhà :<span>*</span></label>
                        <input id="house" class="form-control" type="text" name="house"
                            value="{{ $address->house }}" placeholder="Nhập số nhà ....">
                        <span style="color: red;font-size: 13px; padding:5px 10px;" class="err house_error"></span>
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            @else
                <form method="post" id="info">
                    @csrf
                    <div class="form-group">
                        <label for="province">Tỉnh/Thành phố:*</label>
                        <input id="province" class="form-control" type="text" name="province" value=""
                            placeholder="Nhập Tỉnh/Thành phố ...">
                        <span style="color: red;font-size: 13px; padding:5px 10px;" class="err province_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="district">Quận/Huyện:<span>*</span></label>
                        <input id="district" class="form-control" type="text" name="district" value=""
                            placeholder="Nhập Quận/Huyện... ">
                        <span style="color: red;font-size: 13px; padding:5px 10px;" class="err district_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="ward">Phường/Xã:*</label>
                        <input id="ward" class="form-control" type="text" name="ward" value=""
                            placeholder="Nhập Phường/Xã...">
                        <span style="color: red;font-size: 13px; padding:5px 10px;" class="err ward_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="house">Tên đường/Toà nhà/Số nhà :<span>*</span></label>
                        <input id="house" class="form-control" type="text" name="house" value=""
                            placeholder="Nhập số nhà ....">
                        <span style="color: red;font-size: 13px; padding:5px 10px;" class="err house_error"></span>
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            @endif

        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#info').submit(function(e) {
                e.preventDefault();
                var data = new FormData(this);
                $.ajax({
                    type: "post",
                    url: "{{ route('user.address.update') }}",
                    data: data,
                    processData: false,
                    dataType: 'json',
                    contentType: false,
                    success: function(response) {
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
