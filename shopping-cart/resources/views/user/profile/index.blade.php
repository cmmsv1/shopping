@extends('layouts.dashboard')
@section('user')
    <div class="container">
        <div class="py-4 px-4">
            <h3 class="text-center">Thông tin cá nhân</h3>
                <div class="row">
                    <div class="col-lg-6">
                        <h5 class="text-center">Thông tin user</h5>
                        <form method="POST" id="formProfile">
                            @csrf
                            <div class="form-group">
                                <label for="">Họ và tên</label>
                                <input type="text" class="form-control" name="name" placeholder="Họ và tên ..." value="{{$user->name}}">
                            </div>
                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="email" class="form-control" name="email" placeholder="Email ..." value="{{$user->email}}">
                            </div>
                            <div class="form-group">
                                <label for="">Phone</label>
                                <input type="number" class="form-control" name="phone" placeholder="Phone ..." value="{{$user->phone}}"> 
                            </div>
                            {{-- <div class="form-group">
                                <label for="">Password</label>
                                <input type="password" class="form-control" name="password">
                            </div>
                            <div class="form-group">
                                <label for="">Confirm Password</label>
                                <input type="password" class="form-control" name="confirm_password">
                            </div> --}}
                            <button type="submit" class="btn btn-primary">Cập nhật</button>
                        </form>
                        
                    </div>
                    <div class="col-lg-6">
                        <h5 class="text-center">Change password</h5>
                        <form action="" id="changePass">
                            @csrf
                            <div class="form-group">
                                <label for="">Current Password</label>
                                <input type="password" class="form-control" name="current_password" autocomplete="off" placeholder="Current Password...">
                                <span style="color: red;font-size: 13px; padding:5px 10px;" class="err current_pass_error"></span>
                            </div>
                            <div class="form-group">
                                <label for="">Password</label>
                                <input type="password" class="form-control" name="password" placeholder="Password..." >
                                <span style="color: red;font-size: 13px; padding:5px 10px;" class="err pass_error"></span>
                            </div>
                            <div class="form-group">
                                <label for="">Confirm Password</label>
                                <input type="password" class="form-control" name="confirm_password" placeholder="Confirm Password..." >
                                <span style="color: red;font-size: 13px; padding:5px 10px;" class="err confirm_pass_error"></span>
                            </div>
                            <button class="btn btn-primary">Change password</button>
                        </form>
                        {{-- <h5 class="text-center">Địa chỉ nhận hàng</h5>
                        <form action="">
                            <div class="form-group">
                                <label for="province">Tỉnh/Thành phố:</label>
                                <input id="province" class="form-control" type="text" name="province" value="" placeholder="Nhập Tỉnh/Thành phố ...">
                                <span style="color: red;font-size: 13px; padding:5px 10px;" class="err province_error"></span>
                            </div>
                            <div class="form-group">
                                <label for="district">Quận/Huyện:<span>*</span></label>
                                <input id="district" class="form-control" type="text" name="district" value="" placeholder="Nhập Quận/Huyện... ">
                                <span style="color: red;font-size: 13px; padding:5px 10px;" class="err district_error"></span>
                            </div>
                            <div class="form-group">
                                <label for="ward">Phường/Xã:</label>
                                <input id="ward" class="form-control" type="text" name="ward"  placeholder="Nhập Phường/Xã...">
                                <span style="color: red;font-size: 13px; padding:5px 10px;" class="err ward_error"></span>
                            </div>
                            <div class="form-group">
                                <label for="house">Tên đường/Toà nhà/Số nhà :<span>*</span></label>
                                <input id="house" class="form-control" type="text" name="house" value="" placeholder="Nhập số nhà ....">
                                <span style="color: red;font-size: 13px; padding:5px 10px;" class="err house_error"></span>
                            </div>
                            <button class="btn btn-primary">Cập nhật</button>
                        </form>
                    </div>
                </div>
            </form>  --}}
        </div>
    </div>

    <script>
        $(document).ready(function () {
            function reset(){
                $('.current_pass_error').text('')
                $('.pass_error').text('')
                $('.confirm_pass_error').text('')
            }
            $('#formProfile').submit(function (e) { 
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    type: "POST",
                    url: "/user/profile/updateProfile",
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
                    }
                });
            });
            $('#changePass').submit(function (e) { 
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    type: "POST",
                    url: "/user/profile/changePass",
                    data: formData,
                    processData: false,
                    dataType: 'json',
                    contentType: false,
                    success: function (response) {
                        if(response.current_pass){
                            reset();
                            $('.current_pass_error').text(response.current_pass)
                        }else if(response.pass){
                            reset();
                            $('.pass_error').text(response.pass)
                        }else if(response.confirm_pass){
                            reset();
                            $('.confirm_pass_error').text(response.confirm_pass)
                        }
                        if(response.message){
                            swal({
                                title: "Success!",
                                text: response.message,
                                icon: "success",
                            }).then(()=>{
                                reset();
                            });
                            
                        }
                    },
                });
            });
        });
    </script>
@endsection