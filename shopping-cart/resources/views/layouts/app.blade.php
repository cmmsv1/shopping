<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Home</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/images/favicon.ico') }}">
    <link
        href="https://fonts.googleapis.com/css?family=Lato:300,400,400italic,700,700italic,900,900italic&amp;subset=latin,latin-ext"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css?family=Open%20Sans:300,400,400italic,600,600italic,700,700italic&amp;subset=latin,latin-ext"
        rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/animate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/font-awesome.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/chosen.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/flexslider.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/color-01.css') }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>

<body class="home-page home-01 ">
    @php
        use Illuminate\Support\Facades\Auth;
        use App\Models\Cart;
        use App\Models\Custom;
        use App\Models\Category;
        if (Auth::check()) {
            $carts = Cart::where('user_id', Auth::id())->get();
            $cart_count = count($carts);
        } else {
            $cart_count = 0;
        }
        $ct = Custom::first();
        if ($ct) {
            $logo = $ct->logo;
            $social = json_decode($ct->social);
        } else {
            $logo = '';
            $social = '';
        }
        $categories = Category::all();
    @endphp
    <!-- mobile menu -->
    <div class="mercado-clone-wrap">
        <div class="mercado-panels-actions-wrap">
            <a class="mercado-close-btn mercado-close-panels" href="#">x</a>
        </div>
        <div class="mercado-panels"></div>
    </div>



    <!--header-->
    @include('page.header')

    <main class="py-4">
        @yield('content')
    </main>

    @include('page.footer')

    <script src="{{ asset('assets/js/jquery-1.12.4.minb8ff.js?ver=1.12.4') }}"></script>
    <script src="{{ asset('assets/js/jquery-ui-1.12.4.minb8ff.js?ver=1.12.4') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.flexslider.js') }}"></script>
    <script src="{{ asset('assets/js/chosen.jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.countdown.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.sticky.js') }}"></script>
    <script src="{{ asset('assets/js/functions.js') }}"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    @yield('script')
    <script>
        $(document).on('click', '.btn-increase', function(e) {
            e.preventDefault();
            var inc_value = $(this).closest('.quantity-input').find('.product_quantity').val();
            var inc_max = $(this).closest('.quantity-input').find('.product_quantity').data('max');
            var value = parseInt(inc_value, 10);
            var value_max = parseInt(inc_max, 10);
            value = isNaN(value) ? 0 : value;
            value_max = isNaN(value_max) ? 0 : value_max;
            if (value < value_max) {
                value++;
                $(this).closest('.quantity-input').find('.product_quantity').val(value);
            }
        });
        $(document).on('click', '.btn-reduce', function(e) {
            e.preventDefault();
            var inc_value = $(this).closest('.quantity-input').find('.product_quantity').val();
            var value = parseInt(inc_value, 10);
            value = isNaN(value) ? 0 : value;
            if (value > 1) {
                value--;
                $(this).closest('.quantity-input').find('.product_quantity').val(value);
            } else {
                value = 1;
                $(this).closest('.quantity-input').find('.product_quantity').val(value);
            }
        });
    </script>
</body>

</html>
