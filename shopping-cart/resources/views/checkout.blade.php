@extends('layouts.app')
@section('content')
    @php
    $address = json_decode(Auth::user()->address);
    $name = Auth::user()->name;
    $phone = Auth::user()->phone;
    @endphp
    <style>
        /* .row-in-form{
                                                                                    padding: 0px 20px;
                                                                                } */
        #paypal-button-container {
            height: 34px;
            width: 130px !important;
            margin-top: 10px;
        }

        .form-input input {
            height: 37px !important;
        }

        .form-input {
            margin-top: 30px;
        }

        .form-input label {
            font-size: 14px;
        }
    </style>
    <main id="main" class="main-site">
        <form id="checkout" method="post">
            @csrf
            <div class="container">

                <div class="wrap-breadcrumb">
                    <ul>
                        <li class="item-link"><a href="{{ route('home') }}" class="link">home</a></li>
                        <li class="item-link"><span>Thanh toán</span></li>
                    </ul>
                </div>
                <div class=" main-content-area">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Tên người nhận hàng</label>
                                <input type="text" name="name" id="name" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Số điện thoại người nhận hàng</label>
                                <input type="text" name="phone" id="phone" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Tỉnh/Thành phố</label>
                                <input type="text" name="province" id="province" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Quận/Huyện</label>
                                <input type="text" name="district" id="district" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Phường/Xã</label>
                                <input type="text" name="ward" id="ward" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Số nhà</label>
                                <input type="text" name="house" id="house" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="comment">Tin nhắn:</label>
                        <textarea class="form-control" rows="2" name="message" placeholder="Lưu ý cho người bán ..." class="message"></textarea>
                    </div>
                    <div class="main-content-area">
                        <div class="wrap-iten-in-cart">
                            <h3 class="box-title">Sản phẩm</h3>
                            <ul class="products-cart">
                                @php
                                    $total = 0;
                                @endphp
                                @if (count($carts) > 0)
                                    @foreach ($carts as $cart)
                                        <li class="pr-cart-item">
                                            <input type="hidden" value="{{ $cart->products->id }}"
                                                class="productcart_id">
                                            <div class="product-image">
                                                <figure><img
                                                        src="{{ asset('assets/images/products') }}/{{ $cart->products->image }}"
                                                        alt=""></figure>
                                            </div>
                                            <div class="product-name">
                                                <a class="link-to-product"
                                                    href="{{ route('product.detail', $cart->products->slug) }}">{{ $cart->products->name }}</a>
                                            </div>
                                            <div class="price-field produtc-price">
                                                <p class="price">
                                                    @php
                                                        echo number_format($cart->products->regular_price, 0, ',', '.') . 'đ';
                                                    @endphp
                                                </p>
                                            </div>
                                            <div class="price-field produtc-price">
                                                <p>x{{ $cart->quantity }}</p>
                                            </div>

                                            <div class="price-field sub-total">
                                                <p class="price">
                                                    @php
                                                        echo number_format($cart->products->regular_price * $cart->quantity, 0, ',', '.') . 'đ';
                                                    @endphp
                                                </p>
                                            </div>
                                        </li>
                                        @php
                                            $total = $total + $cart->products->regular_price * $cart->quantity;
                                        @endphp
                                    @endforeach
                                @else
                                    <div style="padding: 40px">
                                        <p style="text-align: center; font-size: 15px">Giỏ hàng của bạn đang trống.....</p>
                                    </div>
                                @endif

                            </ul>
                        </div>
                    </div>
                    <div class="summary summary-checkout">
                        <div class="summary-item payment-method">
                            <h4 class="title-box">Hình thức thanh toán</h4>
                            {{-- <p class="summary-info"><span class="title">Check / Money order</span></p>
                        <p class="summary-info"><span class="title">Credit Cart (saved)</span></p> --}}
                            <div class="choose-payment-methods" style="margin: 30px 0px">
                                <label class="payment-method">
                                    <input name="payment_method" checked value="0" type="radio">
                                    <span>Thanh toán khi nhận hàng</span>
                                    {{-- <span style="padding: 5px 20px" class="payment-desc">Khách hàng cần cọc 300k để xác
                                        nhận mua hàng</span> --}}
                                </label>
                                <label class="payment-method">
                                    <input name="payment_method" value="1" type="radio">
                                    <span>Thanh toán qua tài khoản ngân hàng</span>
                                    {{-- <span class="payment-desc">There are many variations of passages of Lorem Ipsum available</span> --}}
                                </label>
                                <div id="paypal-button-container"></div>
                                {{-- <label class="payment-method">
                                <input name="payment-method" id="payment-method-paypal" value="paypal" type="radio">
                                <span>Paypal</span>
                                <span class="payment-desc">You can pay with your credit</span>
                                <span class="payment-desc">card if you don't have a paypal account</span>
                            </label> --}}
                            </div>
                            <p class="summary-info grand-total">
                                <span>Tổng tiền: </span> <span class="grand-total-price">
                                    @php
                                        echo number_format($total, 0, ',', '.') . 'đ';
                                    @endphp
                                </span>
                            </p>
                            <input type="hidden" id="total_vnd" name='total' value="{{ $total }}">
                            @php
                                $total_usd = round($total / 23000);
                                Session::put('total_paypal', $total_usd);
                            @endphp
                            <input type="hidden" id="total_usd" value="{{ round($total_usd) }}">
                            <button type="submit" class="btn btn-medium submit">Đặt hàng ngay</button>
                        </div>
                        <div class="summary-item shipping-method">
                            <h4 class="title-box f-title">Shipping method</h4>
                            <p class="summary-info"><span class="title">Flat Rate</span></p>
                            {{-- <h4 class="title-box">Discount Codes</h4>
                        <p class="row-in-form">
                            <label for="coupon-code">Enter Your Coupon code:</label>
                            <input id="coupon-code" type="text" name="coupon-code" value="" placeholder="">	
                        </p> --}}

                            {{-- <button type="submit" class="btn btn-primary"><a style="color: #fff" href="{{route('processTransaction')}}">Thanh toán Paypal</a></button> --}}
                            {{-- <a href="#" class="btn btn-small">Apply</a> --}}
                        </div>
                    </div>

                </div>
                <!--end main content area-->
            </div>
            <!--end container-->

        </form>
    </main>

@endsection
@section('script')
    <script
        src="https://www.paypal.com/sdk/js?client-id=AaBOOOr2qWOPe7lSlRaODNnyMA02UC8Dk9fP9b1SHYMiN9BSUis60JMMNXtr9PMtFlRebOOkeARvKiMi&disable-funding=card">
    </script>
    <script>
        $(document).ready(function() {
            paypal.Buttons({

                onClick: function(data, actions) {
                    var name = $('#name').val();
                    var phone = $('#phone').val();
                    var district = $('#district').val();
                    var province = $('#province').val();
                    var ward = $('#ward').val();
                    var house = $('#house').val();
                    var check = 1;
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    function postData() {


                        $.ajax({
                            type: "POST",
                            url: "{{ route('checkout.checkPaypal') }}",
                            data: {
                                name: name,
                                phone: phone,
                                district: district,
                                province: province,
                                ward: ward,
                                house: house,

                            },
                            success: function(response) {
                                $("#check").prop("checked", true);
                            },
                            error: function(e) {
                                let error = e.responseJSON.errors;
                                for (let key in error) {
                                    $('.' + key + '_error').text(error[key][0]);
                                    $('.' + key + '_error').parent().addClass('has-error');
                                }
                                document.documentElement.scrollTop = 0;
                            },
                        });
                    }
                    postData();

                },
                createOrder: (data, actions) => {
                    return actions.order.create({
                        purchase_units: [{
                            amount: {
                                value: '{{ $total_usd }}' // Can also reference a variable or function
                            }
                        }]
                    });
                },
                // Finalize the transaction after payer approval
                onApprove: (data, actions) => {
                    return actions.order.capture().then(function(details) {
                        console.log(details);

                        // Successful capture! For dev/demo purposes:
                        //alert('Transaction completed by '+details.payer.name.given_name);
                        var name = $('#name').val();
                        var phone = $('#phone').val();
                        var district = $('#district').val();
                        var province = $('#province').val();
                        var ward = $('#ward').val();
                        var house = $('#house').val();
                        var total = $('#total_vnd').val();
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                    'content')
                            }
                        });
                        $.ajax({
                            type: "POST",
                            url: "{{ route('checkout.order') }}",
                            data: {
                                name: name,
                                phone: phone,
                                district: district,
                                province: province,
                                ward: ward,
                                house: house,
                                payment_method: 'Thanh toán Paypal',
                                payment_id: details.id,
                                total: total,

                            },
                            success: function(response) {
                                swal({
                                    title: "Success!",
                                    text: response.message,
                                    icon: "success",
                                });
                            },
                            // error: function (e) {
                            //     console.log(e);
                            //     let error = e.responseJSON.errors;
                            //     for(let key in error){
                            //         $('.'+ key+'_error').text(error[key][0]);
                            //         $('.'+ key+'_error').parent().find('.ip').addClass('is-invalid');
                            //     }
                            //     document.documentElement.scrollTop = 0;
                            // },
                        });
                    });
                }
            }).render('#paypal-button-container');
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#checkout').submit(function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                console.log(formData);
                $.ajax({
                    type: "POST",
                    url: "{{ route('checkout.order') }}",
                    data: formData,
                    processData: false,
                    dataType: 'json',
                    contentType: false,
                    success: function(response) {
                        swal({
                                title: "Success!",
                                text: response.message,
                                icon: "success",
                                buttons: ["Kiểm tra đơn hàng!", "Ở lại trang!"],
                            })
                            .then((ok) => {
                                if (ok) {
                                    window.location.load();
                                } else {

                                    window.location.href = "/user/orders";
                                }
                            });
                    },
                    error: function(e) {
                        let error = e.responseJSON.errors;
                        for (let key in error) {
                            $('.' + key + '_error').text(error[key][0]);
                            $('.' + key + '_error').parent().addClass('has-error');
                        }
                        document.documentElement.scrollTop = 0;
                    },
                });
            });
        });
    </script>
@endsection
